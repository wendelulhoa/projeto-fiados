<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Payments;
use App\Models\Purchases;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{

    /**
     * Tela inicial do cliente.
     *
     * @param integer $month
     * @param integer $year
     * @return view
     */ 
    public function index($month, $year)
    {
        try {
            /* Busca os pagamentos. */
            $closedPayments = Payments::closedPayments(Auth::user()->id, $month, $year, 6);
            $openPayments   = Payments::openPayments(Auth::user()->id, $month, $year, 6);
            $limit          = Clients::getLimit(Auth::user()->id);
            $purchases      = Purchases::getAllPurchases(Auth::user()->id, $month, $year);
            $totalPayment   = 0.00;
            $totalPurchase  = 0.00;
            $titlePage      = 'Dashboard';

            /* Pega todos pagamentos  e todas compras*/
            $allClosedPayments = Payments::getAllClosedpayments(Auth::user()->id, $month, $year);
            $allPurchases      = Purchases::getAllPurchases(Auth::user()->id, $month, $year, false);

            /* Faz a soma dos pagamentos.*/
            foreach ($allClosedPayments as $payment) {
                $totalPayment += $payment->amount ?? 0.00;
            }

            /* Faz a soma das compras.*/
            foreach ($allPurchases as $purchase) {
                $totalPurchase += $purchase->amount ?? 0.00;
            }

            /* Salva o ano e o mes*/
            Session::put('month', $month);
            Session::put('year', $year);

            return view('client.index', ['closedPayments' => $closedPayments, 'openPayments' => $openPayments, 'limit' => $limit, 'totalPurchase' => $totalPurchase, 'totalPayment' => $totalPayment, 'purchases' => $purchases]);
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * salvar um novo cliente
     *
     * @param Request $request
     * @return view
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            if (!empty($data)) {
                /* Tira a formatção do cpf. */ 
                $data['cpf']  = unformatedCpf($data['cpf'] ?? 0);  

                $validator = $this->validator($data);

                if ($validator->fails()) {
                    return redirect()->route('admin-create-client-view')->withErrors($validator->errors())->withInput();
                }

                DB::beginTransaction();
                $userId = User::create([
                    'name'     => $data['name'],
                    'email'    => isset($data['email']) && !empty($data['email']) ? $data['email'] : unformatedCpf($data['cpf']),
                    'password' => Hash::make($data['password']),
                    'active'   => true,
                    'image'    => null,
                    'type_user'=>  isset($data['typeuser']) && !empty($data['typeuser']) ? $data['typeuser'] : 0
                ])->id;

                Clients::create([
                    'birth'     => Carbon::createFromFormat('Y-m-d', $data['birth']),
                    'cpf'       =>  unformatedCpf($data['cpf']),
                    'user_id'   => $userId,
                    'limit'     => convertToDecimal($data['limit'])
                ]);
                DB::commit();
            }
            return redirect(route('admin-edit-client-view', ['id'=> $userId]));
        } catch (Exception $e) {
            DB::rollback();
            abort(500);
        }
    }
    
    /**
     * salvar um novo cliente
     *
     * @param Request $request
     * @return view
     */
    public function update(Request $request)
    {
        try {
            $data = $request->all();
            if (!empty($data)) {
                /* Tira a formatção do cpf. */ 
                $data['cpf']  = unformatedCpf($data['cpf'] ?? 0);  

                if(isset($data['cpf']) && strlen($data['cpf']) < 11 || isset($data['cpf']) && strlen($data['cpf']) > 11 || !isset($data['cpf'])) {
                    $validator['cpf'] = 'verifique o cpf e tente novamente';
                    return redirect()->route('admin-edit-client-view', ['id'=> $data['user_id']])->withErrors($validator)->withInput();
                }

                DB::beginTransaction();
                if(isset($data['password']) && !empty($data['password'])) {
                    User::where(['id'=> $data['user_id']])->update([
                        'name'     => $data['name'],
                        // 'email'    => isset($data['email']) && !empty($data['email']) ? $data['email'] : unformatedCpf($data['cpf']),
                        'password' => Hash::make($data['password']),
                        'type_user'=> isset($data['typeuser']) && !empty($data['typeuser']) ? $data['typeuser'] : 0
                    ]);
                } else {
                    User::where(['id'=> $data['user_id']])->update([
                        'name'     => $data['name'],
                        // 'email'    => isset($data['email']) && !empty($data['email']) ? $data['email'] : unformatedCpf($data['cpf']),
                        'type_user'=> isset($data['typeuser']) && !empty($data['typeuser']) ? $data['typeuser'] : 0
                    ]);
                }

                Clients::where(['user_id'=> $data['user_id']])->update([
                    'birth'     => Carbon::createFromFormat('Y-m-d', $data['birth']),
                    'cpf'       =>  unformatedCpf($data['cpf']),
                    'user_id'   => $data['user_id'],
                    'limit'     => convertToDecimal($data['limit'])
                ]);

                DB::commit();
                
                return redirect(route('admin-edit-client-view', ['id'=> $data['user_id']]));
            }
            abort(400);
        } catch (Exception $e) {
            DB::rollback();
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
        $titlePage = 'Criar cliente';
        return view('client.create-client', ['titlePage' => $titlePage]);
    }

    /**
     * retorna a view de edição de cliente
     *
     * @return view
     */
    public function getStrutureEdit($id)
    {
        try {
            $client    = Clients::getClient($id);
            $titlePage = 'Editar cliente';

            return view('client.edit-client', ['client'=> $client, 'titlePage' => $titlePage]);
        } catch (Exception $e) {
            abort(500);
        }   
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        if(isset($data['cpf']) && strlen($data['cpf']) < 11 || isset($data['cpf']) && strlen($data['cpf']) > 11 || !isset($data['cpf'])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'cpf', 'Verifique se o cpf foi inserido corretamente.'
                );
            });
        }

        return $validator;
    }
}
