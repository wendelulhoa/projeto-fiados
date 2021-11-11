<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Payments;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{   

    public function index() {
        try {
            /* Busca os pagamentos. */ 
            $closedPayments = Payments::closedPayments(Auth::user()->id);
            $openPayments   = Payments::openPayments(Auth::user()->id);
            $limit          = Clients::getLimit(Auth::user()->id);

            return view('client.index', ['closedPayments'=>$closedPayments, 'openPayments'=> $openPayments, 'limit'=> $limit]);
        } catch (Exception $e) {

        }
    }

    /**
     * salvar um novo cliente
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        try {
            $data = $request->all();
            if(!empty($data)){
                DB::beginTransaction();
                $userId = User::create([
                        'name' => $data['name'],
                        'email' => $data['email'] . 'aa',
                        'password' => Hash::make($data['password']),
                        'active' => true,
                        'image' => null,
                        'type_user'=> 0
                    ])->id;

                Clients::create([
                    'birth' => Carbon::createFromFormat('Y-m-d', $data['birth']), 
                    'cpf' => $data['cpf'],
                    'user_id'=> $userId,
                    'limit' => 1000
                ]);
                DB::commit();
            }
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
        }
    }

    /**
     * retorna a view de criação de cliente
     *
     * @return view
     */
    public function getStrutureCreate()
    {
        return view('client.create-client');
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
