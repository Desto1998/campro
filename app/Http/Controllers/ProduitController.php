<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Comportes;
use App\Models\Pocedes;
use App\Models\Produit_Factures;
use App\Models\Produits;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\AbstractList;
use phpDocumentor\Reflection\Types\Array_;
use Yajra\DataTables\DataTables;

class ProduitController extends Controller
{

    //function for pruducts
    public function listproduct(Request $request)
    {
        $saleDevis = Pocedes::all();
        $sateFacture = Produit_Factures::all();
        $data = Produits::join('categories', 'categories.categorie_id', 'produits.idcategorie')
            ->join('users', 'users.id', 'produits.iduser')
            ->orderBy('produits.created_at', 'desc')
            ->get();
        $categories = Categories::all();
        return view('produit.produit', compact('data', 'categories', 'saleDevis', 'sateFacture'));
    }
    public function loadProducts() {
        if (request()->ajax()) {

            $product2  = [];
            $data  = [];
            $saleDevis = Pocedes::all();
            $sateFacture = Produit_Factures::all();
            $products = Produits::join('categories', 'categories.categorie_id', 'produits.idcategorie')
                ->join('users', 'users.id', 'produits.iduser')
                ->orderBy('produits.created_at', 'desc')
                ->get();
            $categories = Categories::all();

            $stock = 0;
//            $data = [];
            $username = '';
            foreach ($products as $key =>$value){
                $product  = new Array_();

                foreach ($saleDevis as $sd){
                    if ($sd->idproduit==$value->produit_id) {
                        $stock += $sd->quantite ;
                    }
                }

                foreach ($sateFacture as $sf){
                    if ($sf->idproduit==$value->produit_id) {
                        $stock += $sf->quantite ;
                    }
                }
                $product->key = $key;
                $product->produit_id = $value->produit_id;
                $product->reference = $value->reference;
                $product->titre_produit = $value->titre_produit;
                $product->quantite = $value->quantite_produit;
                $product->prix = $value->prix_produit;
                $product->description = $value->description_produit;
                $product->categorie = $value->titre_cat;
                $product->stock = $value->quantite_produit-$stock;
                $product->username = $value->firstname;
//                $product->action = $value->quantite_produit-$stock;

                $data[$key]=$product;

            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action = view('produit.produit_action',compact('row'));

//                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0)" class="edit btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm ml-1"  onclick="deleteFun()"><i class="fa fa-trash"></i></a></div>';
                    return (string)$action;
                })
//                ->addColumn('action', 'produit_action')
                ->rawColumns(['action'])
                ->make(true);
//            $data=[];
//            $data["data"]=$products;
//            dd($data);
//            return Response()->json($data);
        }
    }
    //function create or update product
    public function storeProduct(Request $request)
    {

        $request->validate([
            'titre_produit' => ['required'],
            'idcategorie' => ['required'],
            'quantite_produit' => ['required'],
            'prix_produit' => ['required'],
        ]);
        if (count($request->idcategorie) != count($request->titre_produit) || count($request->quantite_produit) != count($request->prix_produit) || count($request->titre_produit) != count($request->prix_produit)) {
            return redirect()->back()->with('warning', 'Le formulaire a été mal rempli! Rassurez vous de remplir tous les titre, quntite, prix, et categories');
        }
        $iduser = Auth::user()->id;
        $dataId = $request->produit_id;
        $reference = '';
        for ($i = 0; $i < count($request->titre_produit); $i++) {
            $getcat = Categories::where('categorie_id', $request->idcategorie[$i])->get();
//            $generatecode = Produits::where('idcategorie', $request->idcategorie[$i])
//                ->whereRaw('produit_id = (select max(`produit_id`) from produits)')
//                ->get()
//            ;
            Categories::where('categorie_id', $request->idcategorie[$i])->update(['actualNum' => DB::raw('actualNum + 1'),]);
            $actual = $getcat[0]->actualNum;
            $actual += 1;
            $input = $getcat[0]->code_cat;
            $reference = str_pad($actual, 4, "0", STR_PAD_LEFT);
            $reference = $input . $reference;

            $description_produit = '';

            //test if ther is description for actual row
            if (isset($request->description_produit[$i])) {
                $description_produit = $request->description_produit[$i];
            }
            $save = Produits::updateOrCreate(
                ['produit_id' => $dataId],
                [
                    'titre_produit' => $request->titre_produit[$i],
                    'idcategorie' => $request->idcategorie[$i],
                    'reference' => $reference,
                    'quantite_produit' => $request->quantite_produit[$i],
                    'prix_produit' => $request->prix_produit[$i],
                    'description_produit' => $description_produit,
                    'iduser' => $iduser,

                ])
            ;
        }

        return Response()->json($save);
//        if ($save) {
//            return redirect()->back()->with('success', 'Enregistré avec succès!');
//
//        }
//        return redirect()->back()->with('danger', "Désolé une erreur s'est produite. Veillez recommencer!");
    }

//    update product
    public function updateProduct(Request $request)
    {
        $request->validate([
            'titre_produit' => ['required', 'min:3', 'string'],
            'idcategorie' => ['required'],
            'quantite_produit' => ['required'],
            'prix_produit' => ['required'],
        ]);
        $iduser = Auth::user()->id;
        $dataId = $request->produit_id;
        $reference = $request->reference;
        $save = Produits::updateOrCreate(
            ['produit_id' => $dataId],
            [
                'titre_produit' => $request->titre_produit,
                'idcategorie' => $request->idcategorie,
                'reference' => $reference,
                'quantite_produit' => $request->quantite_produit,
                'prix_produit' => $request->prix_produit,
                'description_produit' => $request->description_produit,
                'iduser' => $iduser,

            ]);
        return Response()->json($save);
//        if ($save) {
//            return redirect()->back()->with('success', 'Enregistré avec succès!');
//
//        }
//        return redirect()->back()->with('danger', "Désolé une erreur s'est produite. Veillez recommencer!");
    }

    //delete product
    public function deleteProduct(Request $request)
    {
        $delete = Produits::where('produit_id', $request->id)->delete();
        return Response()->json($delete);
    }
}
