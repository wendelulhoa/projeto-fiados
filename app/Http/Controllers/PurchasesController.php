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
            if(!empty($data)){
                DB::beginTransaction();
                $paymentActive = Payments::paymentActive($data['client']);
                
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

                Purchases::create([
                    'day'    => Carbon::now()->format('d'), 
                    'month'  => Carbon::now()->format('m'),
                    'year'   => Carbon::now()->format('Y'), 
                    'amount' => $data['amount'], 
                    'user_id'=> $data['client'], 
                    'payment_id' => $paymentId
                ]);
                DB::commit();
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
}
