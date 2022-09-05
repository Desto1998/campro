<?php

namespace App\Http\Controllers;

use App\Models\Equipements;
use App\Models\Personnels;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        //
        $data = Equipements::latest()->paginate(5);
        $user = User::all();
        return view('equipement.equipement',compact('data','user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
//        return view('equipement.equipement',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


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
            'libelle' => ['required', 'min:3', 'string'],
        ]);
        $iduser = Auth::user()->id;
        $dataId = $request->equipement_id;
        $checkCode = Equipements::where('equipement_id','!=',$dataId)
            //->where('titre_cat',$request->titre_cat)
            ->where('code', $request->code)->get();
        if (count($checkCode) > 0) {
            return redirect()->back()->with('warning', 'Un équipemment  avec ce code existe déja!');

        }

        $save = Equipements::updateOrCreate(
            ['equipement_id' => $dataId],
            [
                'libelle' => $request->libelle,
                'code' => strtoupper($request->code),
                'description' => $request->description,
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
     * @param  \App\Models\Equipements  $equipements
     * @return \Illuminate\Http\Response
     */
    public function show(Equipements $equipements)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipements  $equipements
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipements $equipements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipements  $equipements
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipements $equipements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipements  $equipements
     *
     */
    public function destroy(Equipements $equipements)
    {
        $equipements->delete();

        return redirect()->route('equipement.index')
            ->with('success','Product deleted successfully');
//        $delete = Equipements::where('equipement_id',$equipements->id)->delete();
//        return Response()->json($delete);
    }
}
