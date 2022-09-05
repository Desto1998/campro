<?php

namespace App\Http\Controllers;

use App\Models\Equipements;
use App\Models\Personnels;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonnelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $data = Personnels::latest()->paginate(5);
        $user = User::all();
        return view('personnel.personnel',compact('data','user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {

        $request->validate([
            'code' => ['required', 'min:3', 'string'],
            'nom' => ['required', 'min:3', 'string'],
            'prenom' => ['required', 'min:3', 'string'],
            'tel' => ['required', 'min:3', 'string'],
        ]);
        $iduser = Auth::user()->id;
        $dataId = $request->personnel_id;
        $checkCode = Personnels::where('personnel_id','!=',$dataId)
            //->where('titre_cat',$request->titre_cat)
            ->where('code', $request->code)->get();
        if (count($checkCode) > 0) {
            return redirect()->back()->with('warning', 'Une personne avec ce code existe déja!');
//            $statut = 0;
            // retourne 0 si une categorie existe deja avec ce code
//            return  Response()->json($statut);
        }

        $save = Personnels::updateOrCreate(
            ['personnel_id' => $dataId],
            [
                'code' => $request->code,
                'nom' => strtoupper($request->nom),
                'prenom' => $request->prenom,
                'poste' => $request->poste,
                'email_p' => $request->email_p,
                'tel' => $request->tel,
                'adresse_p' => $request->adresse_p,
                'date_ajout' => date("Y-m-d"),
                'iduser' => $iduser,

            ]);
//        return Response()->json($save);
        if ($save) {
            return redirect()->back()->with('success', 'Enregistré avec succès!');

        }
        return redirect()->back()->with('danger', "Désolé une erreur s'est produite. Veillez recommencer!");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personnels  $personnels
     * @return \Illuminate\Http\Response
     */
    public function show(Personnels $personnels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personnels  $personnels
     * @return \Illuminate\Http\Response
     */
    public function edit(Personnels $personnels)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personnels  $personnels
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personnels $personnels)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personnels  $personnels
     *
     */
    public function destroy(Personnels $personnels)
    {

        $personnels->delete();
        return redirect()->route('personnel.index')
            ->with('success','Supprimé avec succès');
    }
}
