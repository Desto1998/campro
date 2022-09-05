<?php

namespace App\Http\Controllers;

use App\Models\Charges;
use App\Models\Clients;
use App\Models\Commandes;
use App\Models\Devis;
use App\Models\Employe;
use App\Models\Factures;
use App\Models\Fournisseurs;
use App\Models\Produit_Factures;
use App\Models\Produits;
use App\Models\Requete;
use App\Models\Taches;
use App\Models\User;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\True_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $iduser = Auth::user()->id;
        $employe = User::all();
        $requetes = Requete::all();
        $accepeter = Requete::where('statut',1)->get();
        $refuser = Requete::where('statut',2)->get();
        $attente = Requete::where('statut',0)->get();

        $accepeter1 = Requete::where('id_emp',$iduser)->where('statut',1)->get();
        $refuser1 = Requete::where('id_emp',$iduser)->where('statut',2)->get();
        $attente1 = Requete::where('id_emp',$iduser)->where('statut',0)->get();
       return view('dashboard',compact('employe','attente','accepeter','refuser','accepeter1','attente1','refuser1','requetes'));
    }

    public function text()
    {
        return redirect(route('home'))->with('warning','Un bon test reuissi toujours!');
    }

}
