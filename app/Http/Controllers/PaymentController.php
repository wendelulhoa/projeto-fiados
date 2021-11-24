<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Notifications;
use App\Models\Payments;
use App\Models\Purchases;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{

    /**
     * Realiza o pagamento
     *
     * @param Request $request
     * @return json
     */
    public function payment(Request $request) {
        try {
            $data = $request->all();
            if(!empty($data)){
                DB::beginTransaction();
                    $paymentActive = Payments::paymentActive($data['client']);
                    if(!empty($paymentActive)) {
                        $purchases           = Purchases::where(['payment_id'=>$paymentActive->id])->get();
                        $purchasesTotal      = 0.00; 
                        $amountPaymentActive = $paymentActive->amount;

                        /* Faz a soma das contas.*/ 
                        foreach($purchases as $item) {
                            $purchasesTotal += floatval($item->amount);
                        }

                        /* Se vier zero é pq não foi feito compra, logo pega do pagamento ativo. */ 
                        if($purchasesTotal == 0.00 && $amountPaymentActive > 0.00) {
                            $purchasesTotal = $amountPaymentActive;
                        }

                        /* Verifica se realmente tem algo a pagar. */ 
                        if(convertToDecimal($data['amount']) > $purchasesTotal || $purchasesTotal == 0.00) {
                            return response()->json(['message'=> 'o valor não pode exeder o total de compras.'], 400);
                        }

                        /* Faz a subtração para pegar o valor restante. */ 
                        $purchasesTotal -= convertToDecimal($data['amount']);
                        
                        /* Paga a conta e depois faz um novo pagamento em aberto. */ 
                        Payments::where(['user_id' => $data['client'], 'active'=> true])->update(['date_payment'=> Carbon::now(), 'active'=> false, 'amount'=> convertToDecimal($data['amount'])]);
                        
                        Payments::create([
                            'date_payment' => Carbon::now(),
                            'amount'       => $purchasesTotal,
                            'month'        => Carbon::now()->format('m'),
                            'year'         => Carbon::now()->format('Y'), 
                            'user_id'      => $data['client'], 
                            'active'       => true
                        ])->id;
                        
                        NotificationsController::notifyAdminAndClientPayment($data['client'], convertToDecimal($data['amount']));

                        DB::commit();
                        return response()->json(['message'=> 'Pagamento realizado com sucesso.', 'amount'=> moneyConvert($purchasesTotal)], 200);
                    } else {
                        DB::rollBack();
                        return response()->json(['message'=> 'Ops! não possui compras ativas para pagamento.'], 400);
                    }
            }
            
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message'=> 'Ops! não possui compras ativas para pagamento.'], 500);
        }
    }

    /**
     * retorna a view de pagamento
     * @param integer $id
     * @return view
     */
    public function getStruturePayment($id = null)
    {
        try {
            if($id != null) {
                $client = Clients::getClient($id);
                $openPayment   = Payments::paymentActive($id);
                $limit          = Clients::getLimit($id);

                return view('client.payment-purchase', ['client'=> $client, 'limit' => $limit, 'openPayment'=> $openPayment,'id' => $id]);
            } else {
                $clients = Clients::getAllClients();
                return view('client.payment-purchase', ['clients'=>$clients, 'id' => $id]);
            }
        } catch (Exception $e) {
            abort(500);
        }
    }

    /**
     * retorna a view de pagamento abertos.
     * @param integer $id
     * @param integer $year
     * @param integer $month
     * @return view
     */
    public function getStrutureOpenPayments($month, $year, $id = null) {
        try {
            $openPayments = Payments::openPayments($id, $month, $year);
            
            /* Salva o ano e o mes*/ 
            Session::put('month', $month);
            Session::put('year', $year);

            return view('client.open-payments', ['openPayments'=>$openPayments]);
        } catch (Exception $e) {
            abort(500);
        }
    }

    /**
     * retorna a view de pagamentos concluidos.
     * @param integer $id
     * @param integer $year
     * @param integer $month
     * @return view
     */
    public function getStrutureClosedPayments($month, $year, $id = null) {
        try {
            $closedPayments = Payments::closedPayments($id, $month, $year);

            /* Salva o ano e o mes*/ 
            Session::put('month', $month);
            Session::put('year', $year);

            return view('client.closed-payments', ['closedPayments'=>$closedPayments]);
        } catch (Exception $e) {
            abort(500);
        }
    }
}
