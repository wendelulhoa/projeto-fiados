<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Notifications;
use App\Models\Payments;
use App\Models\Purchases;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                        $note                = isset($data['note']) ? $data['note'] : '';

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
                            'func_id'      => Auth::user()->id,  
                            'note'         => $note,  
                            'active'       => true
                        ])->id;
                        
                        /* Notifica o cliente e os administradores. */ 
                        NotificationsController::notifyAdminAndClientPayment($data['client'], convertToDecimal($data['amount']), $note);

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
                $limit         = Clients::getLimit($id);
                $titlePage     = 'Pagar';

                return view('client.payment-purchase', ['client'=> $client, 'limit' => $limit, 'openPayment'=> $openPayment,'id' => $id, 'titlePage' => $titlePage]);
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
            $titlePage    = 'Pagamentos em aberto';
            
            /* Salva o ano e o mes*/ 
            Session::put('month', $month);
            Session::put('year', $year);

            return view('client.open-payments', ['openPayments'=>$openPayments, 'titlePage' => $titlePage]);
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
            $titlePage      = 'Pagamentos';

            /* Salva o ano e o mes*/ 
            Session::put('month', $month);
            Session::put('year', $year);

            return view('client.closed-payments', ['closedPayments'=>$closedPayments, 'titlePage' => $titlePage]);
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function getCoins() {

        try {
            /* Construindo URL */
            $url = "https://economia.awesomeapi.com.br/json/last/EUR-USD,AUD-USD,GBP-USD,ETH-USD,BTC-USD";

            /* Realizando Consulta */
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $bidAndAsk  = Session::get('bidAndAsk') ?? [];

            /* Obtendo Resposta da Consulta */
            $body       = curl_exec($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $coins      = json_decode($body);
            
            /* Coloca a posição de estilos. */ 
            $coins->EURUSD->style = '';
            $coins->AUDUSD->style = '';
            $coins->GBPUSD->style = '';

            if(count($bidAndAsk['count'] ?? []) == 10) {
                Session::put('bidAndAsk', []);
                $sumAsk = ['EURUSD' => 0.00, 'AUDUSD' => 0.00, 'GBPUSD' => 0.00, 'ETHUSD' => 0.00, 'BTCUSD' => 0.00];
                $sumBid = ['EURUSD' => 0.00, 'AUDUSD' => 0.00, 'GBPUSD' => 0.00, 'ETHUSD' => 0.00, 'BTCUSD' => 0.00];

                foreach ($bidAndAsk['ask'] as $keyCoin => $valuesCoin) {
                    foreach($valuesCoin as $value) {
                        $sumAsk[$keyCoin] = bcadd($sumAsk[$keyCoin], $value, 4); 
                    }
                }

                foreach ($bidAndAsk['bid'] as $keyCoin => $valuesCoin) {
                    foreach($valuesCoin as $value) {
                        $sumBid[$keyCoin] = bcadd($sumBid[$keyCoin], $value, 4); 
                    }
                }
                
                foreach($sumBid as $keyCoin => $value) {
                    $coins->$keyCoin->med = $value / count($bidAndAsk['count'] ?? []);
                    Session::put($keyCoin. 'Med', $coins->$keyCoin->med. ' diff: ' . bcsub(floatval(number_format($coins->$keyCoin->med, 4, '.', '')) , floatval(number_format($coins->$keyCoin->bid, 4, '.', '')), 4) . ' -----  ---');

                    if($coins->$keyCoin->med > $coins->$keyCoin->bid) {
                        $coins->$keyCoin->style = 'color:green';
                        Session::put($keyCoin. 'Style', 'color:green');
                        
                        switch($keyCoin) {
                            case 'EURUSD':
                                break;
                            case 'ETHUSD':
                                $command = escapeshellcmd('python /home/wendelulhoa/Documentos/code/projetos_faculdade/projeto-fiados/main.py 742 305');
                                $output = shell_exec($command);
                                break;
                            case 'BTCUSD':
                                    $command = escapeshellcmd('python /home/wendelulhoa/Documentos/code/projetos_faculdade/projeto-fiados/main.py 1318 306');
                                    $output = shell_exec($command);
                                break;
                        }

                    } else if($coins->$keyCoin->med < $coins->$keyCoin->bid) {
                        $coins->$keyCoin->style = 'color:red'; 
                        Session::put($keyCoin. 'Style', 'color:red'); 
                        switch($keyCoin) {
                            case 'EURUSD':
                                break;
                            case 'ETHUSD':
                                $command = escapeshellcmd('python /home/wendelulhoa/Documentos/code/projetos_faculdade/projeto-fiados/main.py 759 379');
                                $output = shell_exec($command);
                                break;
                            case 'BTCUSD':
                                    $command = escapeshellcmd('python /home/wendelulhoa/Documentos/code/projetos_faculdade/projeto-fiados/main.py 1318 373');
                                    $output = shell_exec($command);
                                break;
                        }
                    }
                }
                
                Session::put('hourMed', date('h:i:s'));

                $bidAndAsk = [];
            }
            

            if(!empty($coins)) {
                foreach($coins as $keyCoin => $valueCoin) {
                    $valueAsk     = floatval($coins->$keyCoin->ask);
                    $valueBid     = floatval($coins->$keyCoin->bid);
                    $diff         = bcsub($valueAsk, $valueBid, 4);

                    if(count($bidAndAsk['count'] ?? []) <= 10) {
                        $bidAndAsk['ask'][$keyCoin][] = $valueAsk;
                        $bidAndAsk['bid'][$keyCoin][] = $valueBid;
                    }
                }
            }
            
            if(count($bidAndAsk['count'] ?? []) <= 10) {
                $bidAndAsk['count'][]   = 0;
                Session::put('bidAndAsk', $bidAndAsk);
            }

            $view = view('testes.table-comparison', ['coins' => $coins])->render();

            return $view;

            /* Se retornou dados, gravar no BD */
            if ($statusCode == 200) {
                return response()->json(['EURUSD'=> $coins->EURUSD, 'AUDUSD'=> $coins->AUDUSD, 'GBPUSD' => $coins->GBPUSD]);
            } else {
                response()->json(['error'=>''], 400);
            }
        
        } catch (\Exception $e) {
            dd($e, $coins);
            response()->json(['error'=>''], 400);
        }
    }
}
