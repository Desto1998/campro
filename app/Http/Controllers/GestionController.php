<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Models\Charges;
use App\Models\Clients;
use App\Models\Fournisseurs;
use App\Models\Taches;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Stmt\Return_;
use Yajra\DataTables\DataTables;

class GestionController extends Controller
{
    //Fontion pour les charges
    public function charge()
    {
//        $charges = Charges::join('users','users.id','charges.iduser')->orderBy('charges.created_at','desc' )->get();
        return view('gestion.charges');
    }
    // fontion pour les taches
    public function taches()
    {
        return view('gestion.taches');
    }
public function loadTaches(){
    if (request()->ajax()) {

        $data = Taches::join('users','users.id','taches.iduser')
            ->orderBy('taches.date_ajout','desc' )
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
//            ->addColumn('statut', function($value){
//                $type = '<span class="text-warning">En attente</span>';
//                if ($value->statut==1) {
//                    $type = '<span class="text-success"> Effectué</span>';
//                }
//                if ($value->statut==2) {
//                    $type = '<span class="text-primary"> Non en caisse</span>';
//                }
////                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0)" class="edit btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm ml-1"  onclick="deleteFun()"><i class="fa fa-trash"></i></a></div>';
//                return $type;
//            })
            ->addColumn('action', function($value){
                $charges = Charges::all();
                $action = view('gestion.tache_action',compact('value','charges'));

//                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0)" class="edit btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm ml-1"  onclick="deleteFun()"><i class="fa fa-trash"></i></a></div>';
                return (string)$action;
            })
            ->addColumn('total', function($value){
                $total = $value->nombre*$value->prix;
                return $total;
            })
            ->rawColumns(['action','total'])
            ->make(true);

    }
    return false;
}
    // Store or edit les depenses
    protected function storeTask(Request $request)
    {
        $request->validate([
            'raison' => ['required', 'string', 'min:3'],
            'date_debut' => ['required'],
            'prix' => ['required'],
            'nombre' => ['required'],
        ]);
        $statut = 0;
        $iduser = Auth::user()->id;
        $dataId = $request->tache_id;
        if ($request->is_caisse==0) {
            $request->statut = 2;
        }
        $save = Taches::updateOrCreate(
            ['tache_id' => $dataId],
            [
                'raison' => $request->raison,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_debut,
                'date_ajout' => date('Y-m-d'),
                'iduser' => $iduser,
                'prix' => $request->prix,
                'nombre' => $request->nombre,
                'statut' => $request->statut,

            ])
        ;
//        if ($save) {
//
//            $statut = 1;
//            $factData = new Array_();
//            $factData->key = 'TACHE';
//            $factData->raison = 'Sortie pour les charges';
//            $factData->montant = $request->nombre * $request->prix;
//            $factData->description = $request->raison;
////            if ($dataId) {
////                $d = (new CaisseController())->removeFromCaisse($factData->id,'TACHE');
////            }
//            if ($dataId>0) {
//                $factData->id = $dataId;
//            }else{
//                $factData->id = $save->tache_id;
//            }
//            if ($request->is_caisse==1) {
//                if ((new CaisseController())->soldeCaisse()>=$factData->montant) {
//                    if ((new CaisseController())->storeCaisse($factData)) {
//                        Taches::where('tache_id',$factData->id)->update(['statut'=>1]);
//                        $statut = 2;
//                    }else{
//                        Taches::where('tache_id',$factData->id)->update(['statut'=>0]);
//                    }
//                }else{
//                    Taches::where('tache_id',$factData->id)->update(['statut'=>0]);
//                    $statut = -1;
//                }
//            }
//
//        }
        return Response()->json($save);
//        if ($save) {
//            return redirect()->back()->with('success','Enregistré avec succès!');
//
//        }
//        return redirect()->back()->with('danger', "Désolé une erreur s'est produite. Veillez recommencer!");
    }

    public function markTaskAsDone(Request $request){
        $statut =-2;
        if ($request->ajax()) {
            $statut =0;
            $data = Taches::where('tache_id',$request->id)->get();
            $factData = new Array_();
            $factData->key = 'TACHE';
            $factData->raison = 'Sortie pour les charges';
            $factData->montant = $data[0]->nombre * $data[0]->prix;
            $factData->description = $data[0]->raison;
            $factData->id = $request->id;
            if ((new CaisseController())->soldeCaisse()>=$factData->montant) {
                if ((new CaisseController())->storeCaisse($factData)) {
                    Taches::where('tache_id',$request->id)->update(['statut'=>1]);
                    $statut = 1;
                }
            }else{
                $statut = -1;
            }

        }
        return Response()->json($statut);
    }

    protected function deleteTache(Request $request){
        $delete = Taches::where('tache_id',$request->id)->delete();
        if ($delete) {
            $d = (new CaisseController())->removeFromCaisse($request->id,'TACHE');
        }

        return Response()->json($delete);
    }
}
