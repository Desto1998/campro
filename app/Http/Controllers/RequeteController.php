<?php

namespace App\Http\Controllers;

use App\Models\DateFormation;
use App\Models\Domaine;
use App\Models\DoRe;
use App\Models\Employe;
use App\Models\Formateur;
use App\Models\Formations;
use App\Models\Requete;
use App\Models\Sous_Domaine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class RequeteController extends Controller
{
    public function index(){
        $data = Requete::orderBy('created_at','desc')->get();
        $personnels = \App\Models\User::all();
        $formateurs = Formateur::all();
        $formations = Formations::join('date_formation','formation.id_formation','date_formation.id_for')->get();
        $domaines = Domaine::all();
        $sousdo = Sous_Domaine::join('do_re','do_re.id_sousdo','sous_domaine.id_sousdo')->get();
        return view('requette.index',compact('data','sousdo','personnels','domaines','formateurs','formations'));
    }

    public function mesRequette(){
        $iduser = Auth::user()->id;
        $data = Requete::orderBy('created_at','desc')->where('id_emp',$iduser)->get();
        $personnels = \App\Models\User::all();
        $formateurs = Formateur::all();
        $formations = Formations::join('date_formation','formation.id_formation','date_formation.id_for')->get();
        $domaines = Domaine::all();
        $sousdo = Sous_Domaine::join('do_re','do_re.id_sousdo','sous_domaine.id_sousdo')->get();
        return view('requette.mesrequete',compact('data','sousdo','personnels','domaines','formateurs','formations'));
    }

    public function create(){
        $domaine = Sous_Domaine::all();
        $formation = Formations::all();
        return view('requette.create', compact('domaine','formation'));
    }
    public function store(Request $request){
        $request->validate([
            'object_re' => ['required', 'min:3', 'string'],
            'id_for' => ['required'],
            'id_sousdo' => ['required'],
        ]);
//        dd($request);
        $iduser = Auth::user()->id;

        $save = Requete::create(
            [
                'object_re' =>$request->object_re,
                'date_re' => date('Y-m-d'),
                'dure_re' => 8,
                'id_emp' => $iduser,
                'statut' => 0,
            ]);
        $sa= DateFormation::create(
            [
                'date_debut' =>$request->date_debut,
                'id_re' => $save->id_re,
                'id_for' => $request->id_for,
                'competence' => $request->competence,
            ]);
//        for ($i=0;$i<count($request->id_for); $i++){
//            $sa[$i]= DateFormation::create(
//                [
//                    'date_debut' =>$request->date_debut[$request->id_for[$i]],
//                    'id_re' => $save->id_re,
//                    'id_for' => $request->id_for[$i],
//                ]);
//        }

        for ($i=0;$i<count($request->id_sousdo); $i++){
            $sa[$i]= DoRe::create(
                [
//                    'date_debut' =>$request->date_debut,
                    'id_re' => $save->id_re,
                    'id_sousdo' => $request->id_sousdo[$i],
                ]);
        }

//        return Response()->json($save);
        if ($save) {

            return redirect()->route('requette.mes')->with('success', 'Enregistré avec succès!');

        }
    }

    public function show($id){
        $iduser = Auth::user()->id;
        $data = Requete::find($id);
        $domaine = Sous_Domaine::all();
        $formation = Formations::all();
        $infos = DateFormation::where('id_re',$id)->get();
        $employes = User::find($data->id_emp);
        $formations = Formations::join('date_formation','formation.id_formation','date_formation.id_for')->get();
        $domaines = Domaine::all();
        $sousdo = Sous_Domaine::join('do_re','do_re.id_sousdo','sous_domaine.id_sousdo')->get();
        return view('requette.detail',compact('formation','infos','sousdo','domaines','formations','employes','data','domaine'));
    }

    public function edit($id){
        $data = Requete::find($id);
        $domaine = Sous_Domaine::all();
        $formation = Formations::all();
        $infos = DateFormation::where('id_re',$id)->get();
        return view('requette.edit',compact('formation','infos','data','domaine'));
    }
    public function update(Request $request){
        $request->validate([
            'object_re' => ['required', 'min:3', 'string'],
            'id_for' => ['required'],
            'id_sousdo' => ['required'],
        ]);
        $iduser = Auth::user()->id;
        $save = Requete::where('id_re',$request->id_re)->update(
            [
                'object_re' =>$request->object_re,
//                'date_re' => date('Y-m-d'),
                'dure_re' => 8,
                'id_emp' => $iduser,
//                'statut' => 1,
            ]);
        DateFormation::where('id_re',$request->id_re)->delete();
        DoRe::where('id_re',$request->id_re)->delete();
        $sa= DateFormation::create(
            [
                'date_debut' =>$request->date_debut,
                'id_re' => $save->id_re,
                'id_for' => $request->id_for,
                'competence' => $request->competence,
            ]);
//        for ($i=0;$i<count($request->id_for); $i++){
//            $sa[$i]= DateFormation::create(
//                [
//                    'date_debut' =>$request->date_debut[$request->id_for[$i]],
//                    'id_re' => $save->id_re,
//                    'id_for' => $request->id_for[$i],
//                ]);
//        }

        for ($i=0;$i<count($request->id_sousdo); $i++){
            $sa[$i]= DoRe::create(
                [
//                    'date_debut' =>$request->date_debut,
                    'id_re' => $save->id_re,
                    'id_sousdo' => $request->id_sousdo[$i],
                ]);
        }

//        return Response()->json($save);
        if ($save) {

            return redirect()->route('requette.mes')->with('success', 'Enregistré avec succès!');

        }
    }
    public function delete(Request $request){
        DateFormation::where('id_re',$request->id)->delete();
        DoRe::where('id_re',$request->id)->delete();
        $delete = Requete::where('id_re', $request->id)->delete();
        return Response()->json($delete);
    }


    public function valider($id){
         Requete::where('id_re',$id)->update(['statut'=>1]);
        return redirect()->back()->with('success', "Enfectué avec succès!");
    }

    public function valider2(Request $request){
        $request->validate([
            'date' => ['required',],
            'fin' => ['required'],
            'id_re' => ['required'],
        ]);
        $save = Requete::where('id_re',$request->id_re)->update(
            [
                'date_debut' =>$request->date,
//                'date_re' => date('Y-m-d'),
                'date_fin' => $request->fin,
                'description' => $request->description,
                'statut' => 1,
            ]);
        return redirect()->back()->with('success', "Enfectué avec succès!");
    }

    public function rejet(Request $request){
        $request->validate([
//            'date' => ['required',],
//            'fin' => ['required'],
            'id_re' => ['required'],
        ]);
        $save = Requete::where('id_re',$request->id_re)->update(
            [
//                'date_debut' =>$request->date,
////                'date_re' => date('Y-m-d'),
//                'date_fin' => $request->fin,
                'description' => $request->description,
                'statut' => 2,
            ]);
        return redirect()->back()->with('success', "Enfectué avec succès!");
    }
    public function regeter($id){
        Requete::where('id_re',$id)->update(['statut'=>2]);
        return redirect()->back()->with('success', "Enfectué avec succès!");
    }
    public function bloquer($id){
        Requete::where('id_re',$id)->update(['statut'=>0]);
        return redirect()->back()->with('success', "Enfectué avec succès!");
    }

    public function print(Request $request){
        $request->validate([
            'debut' => ['required'],
            'fin' => ['required'],
        ]);
        $debut = $request->debut;
        $fin = $request->fin;
        if ($request->statut==2) {
            $data = Requete::where('statut',2)->orderBy('created_at','desc')->where('created_at','>=',$debut)->where('created_at','<=',$fin)->get();

        }elseif($request->statut==1){
            $data = Requete::where('statut',1)->orderBy('created_at','desc')->where('created_at','>=',$debut)->where('created_at','<=',$fin)->get();

        }else{
            $data = Requete::orderBy('created_at','desc')->where('created_at','>=',$debut)->where('created_at','<=',$fin)->get();

        }
        $personnels = \App\Models\User::all();
        $formateurs = Formateur::all();
        $formations = Formations::join('date_formation','formation.id_formation','date_formation.id_for')->get();
        $domaines = Domaine::all();
        $sousdo = Sous_Domaine::join('do_re','do_re.id_sousdo','sous_domaine.id_sousdo')->get();
        $pdf = PDF::loadView('requette.print', compact('data', 'sousdo','personnels','domaines','formateurs','formations','debut','fin'))->setPaper('a4', 'portrait')->setWarnings(false);
        return $pdf->stream('requete_du_' .$request->debut. 'au'.$request->fin .date("d-m-Y H:i:s") . '.pdf');
    }
}
