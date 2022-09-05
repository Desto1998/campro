<?php

namespace App\Http\Controllers;

use App\Models\Formateur;
use App\Models\Formations;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormationsController extends Controller
{
    //
    public function index(){
        $data = Formations::all();
        $formateurs = Formateur::all();
        $fournisseurs = Fournisseur::all();
        return view('formation.index',compact('data','fournisseurs','formateurs'));
    }

    public function create(){
        $four = Fournisseur::all();
        return view('formation.create',compact('four'));
    }
    public function store(Request $request){
        $request->validate([
            'titre_for' => ['required', 'min:3', 'string'],
            'id_four' => ['required'],
            'ex_for' => ['required'],
            'nom_for' => ['required'],
            'tel_for' => ['required'],
        ]);

        $save = Formations::create(
            [
                'titre_for' =>$request->titre_for,
                'des_for' => $request->des_for,
                'cout_for' => $request->cout_for,
                'ex_for' => $request->ex_for,
                'type_for' => $request->type_for,
                'type_cout' => $request->type_cout,
                'id_four' => $request->id_four,
            ]);
//        return Response()->json($save);
        if ($save) {
            $for= Formateur::create(
                [
                    'nom_for' =>$request->nom_for,
                    'prenom_for' => $request->prenom_for,
                    'tel_for' => $request->tel_for,
                    'id_formation' => $save->id_formation,
                    'id_four' => $request->id_four,
                ]);
            return redirect()->route('formation.index')->with('success', 'Enregistré avec succès!');

        }
        return redirect()->back()->with('danger', "Désolé une erreur s'est produite. Veillez recommencer!");
    }
    public function edit($id){
        $data = Formations::find($id);
        $formateurs = Formateur::where('id_formation',$id)->get();
        $four = Fournisseur::all();
        return view('formation.edit',compact('data','formateurs','four'));
    }
    public function update(Request $request){
        $request->validate([
            'titre_for' => ['required', 'min:3', 'string'],
            'id_four' => ['required', 'min:3', 'string'],
            'id_formation' => ['required'],
            'ex_for' => ['required'],
        ]);
        $dataId = $request->id_formation;
        $save = Formations::updateOrCreate(
            ['id_formation' => $dataId],
            [
                'titre_for' =>$request->titre_for,
                'des_for' => $request->des_for,
                'cout_for' => $request->cout_for,
                'ex_for' => $request->ex_for,
                'type_cout' => $request->type_cout,
                'id_four' => $request->id_four,
            ]);
//        return Response()->json($save);
        if ($save) {
            $dataId2 = $request->id_for;
            $save = Formateur::updateOrCreate(
                ['id_for' => $dataId2],
                [
                    'nom_for' =>$request->titre_for,
                    'prenom_for' => $request->des_for,
                    'tel_for' => $request->cout_for,
                    'id_formation' => $save->id_formation,
                    'id_four' => $request->id_four,
                ]);
            return redirect()->route('formation.index')->with('success', 'Enregistré avec succès!');

        }
        return redirect()->back()->with('danger', "Désolé une erreur s'est produite. Veillez recommencer!");
    }
    public function delete(Request $request){
        $delete = Formations::where('id_formation', $request->id)->delete();
        return Response()->json($delete);
//        return view('formation.index');
    }
}
