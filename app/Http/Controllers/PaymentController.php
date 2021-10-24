<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Payments;
use App\Models\Purchases;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{


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

                        $purchasesTotal += $amountPaymentActive;
                        $purchasesTotal -= floatval($data['amount']);

                        /* Paga a conta e depois faz um novo pagamento em aberto. */ 
                        Payments::where(['user_id' => $data['client'], 'active'=> true])->update(['date_payment'=> Carbon::now(), 'active'=> false, 'amount'=> $data['amount']]);
                        
                        Payments::create([
                            'date_payment' => Carbon::now(),
                            'amount'       => $purchasesTotal, 
                            'user_id'      => $data['client'], 
                            'active'       => true
                        ]);
                    }
                DB::commit();
            }
        } catch (Exception $e) {
            DB::rollBack();
            abort(500);
        }
    }

    /**
     * retorna a view de pagamento
     *
     * @return view
     */
    public function getStruturePayment()
    {
        try {
            $clients = Clients::getAllClients();
            return view('client.payment-purchase', ['clients'=>$clients]);
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function getStrutureOpenPayments() {
        try {
            $openPayments = Payments::openPayments();
            return view('client.open-payments', ['openPayments'=>$openPayments]);
        } catch (Exception $e) {
            dd($e);
            abort(500);
        }
    }

    public function getStrutureClosedPayments() {
        try {
            $closedPayments = Payments::closedPayments();
            return view('client.closed-payments', ['closedPayments'=>$closedPayments]);
        } catch (Exception $e) {
            dd($e);
            abort(500);
        }
    }
}
