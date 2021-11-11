<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Payments;
use App\Models\Purchases;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchasesController extends Controller
{

    /**
     * Undocumented function
     *
     * @return void
     */
    public function store(Request $request) {
        try { 
            $data = $request->all();
            $notApproved   = false;

            if(!empty($data)){
                DB::beginTransaction();
                $paymentActive = Payments::paymentActive($data['client']);
                $purchasesTotal= convertToDecimal($data['amount'] ?? 0.00); 
                $limit         = Clients::where(['user_id'=>$data['client']])->first()->limit;  

                if(empty($paymentActive)) {
                    $paymentId = Payments::create([
                        'date_payment' => Carbon::now(),
                        'amount'       => 0.00, 
                        'user_id'      => $data['client'], 
                        'active'       => true
                    ])->id;
                } else{ 
                    $paymentId = $paymentActive->id;
                }

                $purchases           = Purchases::where(['payment_id'=>$paymentId])->get();
                /* Faz a soma das contas.*/ 
                foreach($purchases as $item) {
                    $purchasesTotal += floatval($item->amount);
                }
    
                if($purchasesTotal > $limit ) {  
                    $notApproved = true;
                } else {
                    Purchases::create([
                        'day'    => Carbon::now()->format('d'), 
                        'month'  => Carbon::now()->format('m'),
                        'year'   => Carbon::now()->format('Y'), 
                        'amount' => convertToDecimal($data['amount']), 
                        'user_id'=> $data['client'], 
                        'payment_id' => $paymentId
                    ]);
                }

                DB::commit();
            }

            if($notApproved) {
                return 'não tem limite sufiente.';
            }
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            abort(500);
        }
    }

    /**
     * retorna a view de criação de cliente
     *
     * @return view
     */
    public function getStrutureCreate()
    {
        try {
            $clients = Clients::getAllClients();
            return view('client.create-purchase', ['clients'=>$clients]);
        } catch (Exception $e) {
            abort(500);
        }
    }

    /**
     * retorna a view de edição de cliente
     *
     * @return view
     */
    public function getStrutureEdit()
    {
        return view('client.create-client');
    }

    /* Retorna todas as compras de um id de pagamento. */ 
    public function getPurchases(Request $request) {
        try {
            $purchases = Purchases::getPurchases($request->payment_id);

            if(isset($purchases[0])) {
                $purchasesView = view('client.components.table-purchases', ['purchases'=> $purchases])->render();
                return response()->json($purchasesView, 200);
            }else{
                return response()->json([], 200);
            }
        } catch (Exception $e) {
            return response()->json(['error'=> $e], 500);
        }
    }
}
