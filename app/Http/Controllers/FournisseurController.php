<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FournisseurController extends Controller
{
    //
    public function index(){
        $data = Fournisseur::all();
        return view('fournisseur.index',compact('data'));
    }

    public function create(){
        return view('fournisseur.create');
    }
    public function store(Request $request){
        $request->validate([
            'nom' => ['required', 'min:3', 'string'],
            'tel' => ['required', 'min:3', 'string'],
        ]);
        $iduser = Auth::user()->id;
        $dataId = $request->id_four;
        $checkCode = Fournisseur::where('email_four',$request->email)->get();
        if (count($checkCode) > 0) {
            return redirect()->back()->with('warning', 'Une personne avec ce code existe déja!');
//            $statut = 0;
            // retourne 0 si une categorie existe deja avec ce code
//            return  Response()->json($statut);
        }

        $save = Fournisseur::updateOrCreate(
            ['id_four' => $dataId],
            [
                'nom_four' => strtoupper($request->nom),
                'type_four' => $request->type,
                'email_four' => $request->email,
                'tel_four' => $request->tel,

            ]);
//        return Response()->json($save);
        if ($save) {
            return redirect()->route('fournisseur.index')->with('success', 'Enregistré avec succès!');

        }
        return redirect()->back()->with('danger', "Désolé une erreur s'est produite. Veillez recommencer!");
//        return view('fournisseur.create');
    }
    public function edit($id){
        $data = Fournisseur::find($id);
        return view('fournisseur.edit',compact('data'));
    }
    public function update(Request $request){
        $request->validate([
            'nom' => ['required', 'min:3', 'string'],
            'tel' => ['required', 'min:3', 'string'],
        ]);
        $iduser = Auth::user()->id;
        $dataId = $request->id_four;
        $checkCode = Fournisseur::where('email_four',$request->email)->where('id_four','!=',$request->id_four)->get();
        if (count($checkCode) > 0) {
            return redirect()->back()->with('warning', 'Un au fournisseur utilise déja cette adresse email!');
//            $statut = 0;
            // retourne 0 si une categorie existe deja avec ce code
//            return  Response()->json($statut);
        }

        $save = Fournisseur::updateOrCreate(
            ['id_four' => $dataId],
            [
                'nom_four' => strtoupper($request->nom),
                'type_four' => $request->type,
                'email_four' => $request->email,
                'tel_four' => $request->tel,

            ]);
//        return Response()->json($save);
        if ($save) {
            return redirect()->route('fournisseur.index')->with('success', 'Enregistré avec succès!');

        }
        return redirect()->back()->with('danger', "Désolé une erreur s'est produite. Veillez recommencer!");
    }
    public function delete(Request $request){
        $delete = Fournisseur::where('id_four', $request->id)->delete();
        return Response()->json($delete);
    }
}
