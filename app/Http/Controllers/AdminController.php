<?php

namespace App\Http\Controllers;

use App\Models\CategoryGames;
use App\Models\CategoryMods;
use App\Models\Clients;
use App\Models\Mods;
use App\Models\Payments;
use App\Models\Posts;
use App\Models\Purchases;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    /**
     * Tela do admin.
     *
     * @param integer $month
     * @param integer $year
     * @return view
     */ 
    public function index($month, $year)
    {
        try {
            /* Faz as buscas para pegar as informações da tela de admin. */ 
            $closedPayments = Payments::closedPayments(null,$month, $year, 6);
            $openPayments   = Payments::openPayments(null, $month, $year, 6);
            $purchases      = Purchases::getAllPurchases(null, $month, $year);
            $totalClients   = Clients::getTotalClients();
            $totalPayment   = 0.00;
            $totalPurchase  = 0.00;
            
            /* Pega todos pagamentos  e todas compras*/ 
            $allClosedPayments = Payments::getAllClosedpayments(null, $month, $year);
            $allPurchases      = Purchases::getAllPurchases(null, $month, $year, false);
            $salesQuantity     =  count($allPurchases);
            $titlePage         = 'Dashboard';
            
            /* Faz a soma dos pagamentos.*/ 
            foreach($allClosedPayments as $payment) {
                $totalPayment += $payment->amount ?? 0.00;
            }

            /* Faz a soma das compras.*/ 
            foreach($allPurchases as $purchase) {
                $totalPurchase += $purchase->amount ?? 0.00; 
            }

            /* Salva o ano e o mes*/ 
            Session::put('month', $month);
            Session::put('year', $year);
            
            return view('admin.index', ['closedPayments' =>$closedPayments,'openPayments' =>$openPayments, 'purchases' => $purchases, 'totalClients' => $totalClients, 'totalPurchase' => $totalPurchase, 'totalPayment' => $totalPayment, 'salesQuantity' => $salesQuantity, 'titlePage' => $titlePage ]);
        } catch (Exception $e) {
            abort(500);
        }
    }
}
