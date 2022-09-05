<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CaisseController;
use App\Http\Controllers\FormationsController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\RequeteController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AccountValidation;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\LicenceCheck;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'login');
Route::get('dologout', [LoginController::class, 'doLogout']);
Route::post('update/pwd', [ForgotPasswordController::class, 'ResetPassword'])->name('update.password');
Route::post('send/reserPassword/link', [ForgotPasswordController::class, 'sendResetPasswordLink'])->name('send.reset.link');
Route::get('resetPassword/infos/{_token}/{email}/{date}', [ForgotPasswordController::class, 'ResetPasswordInfo'])->name('reset.password.data');
Route::view('/privacy-term', 'privacy-term')->name('privacy.term');

Auth::routes();


//Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/text', [HomeController::class, 'text'])->name('text');

//Route::get('dashboard/validate/{id}', [RegisterController::class, 'validateAcount'])->name('account.validate');
Route::get('/home', function () {
    return redirect()->route('home');
});
Route::prefix('dashboard')->group(function () {

    Route::get('/', [HomeController::class, 'index']);

    Route::group(['middleware' => 'auth'], function () {

        //Route for user only for active user with valid licence
        Route::middleware([AccountValidation::class])->group(function () {
            Route::get('home', [HomeController::class, 'index'])->name('home');

            //Route for for profile account
            Route::get('user/profile', [UserController::class, 'showProfile'])->name('user.profile');
            Route::post('user/updateInfos', [UserController::class, 'updateInfos'])->name('user.edit.infos');
            Route::post('user/updatepassword', [UserController::class, 'updatePassword'])->name('user.edit.password');
            Route::post('user/profile/image', [UserController::class, 'UpdateImage'])->name('user.profil.image');

//            Route::get('formation', [FormationsController::class, 'index'])->name('formation.index');
//            Route::get('formation/create', [FormationsController::class, 'create'])->name('formation.create');
//            Route::post('formation/store', [FormationsController::class, 'store'])->name('formation.store');
//            Route::get('formation/edit/{id}', [FormationsController::class, 'edit'])->name('formation.edit');
//            Route::post('formation/update', [FormationsController::class, 'update'])->name('formation.update');
//            Route::post('formation/delete', [FormationsController::class, 'delete'])->name('formation.delete');
//
//            Route::get('fournisseur', [FournisseurController::class, 'index'])->name('fournisseur.index');
//            Route::get('fournisseur/create', [FournisseurController::class, 'create'])->name('fournisseur.create');
//            Route::post('fournisseur/store', [FournisseurController::class, 'store'])->name('fournisseur.store');
//            Route::get('fournisseur/edit/{id}', [FournisseurController::class, 'edit'])->name('fournisseur.edit');
//            Route::post('fournisseur/update', [FournisseurController::class, 'update'])->name('fournisseur.update');
//            Route::post('fournisseur/delete', [FournisseurController::class, 'delete'])->name('fournisseur.delete');

            Route::get('requette/mesrequette', [RequeteController::class, 'mesRequette'])->name('requette.mes');
            Route::get('requette/create', [RequeteController::class, 'create'])->name('requette.create');
            Route::post('requette/store', [RequeteController::class, 'store'])->name('requette.store');
            Route::get('requette/edit/{id}', [RequeteController::class, 'edit'])->name('requette.edit');
            Route::post('requette/update', [RequeteController::class, 'update'])->name('requette.update');
            Route::post('requette/delete', [RequeteController::class, 'delete'])->name('requette.delete');

            Route::get('requette/show/{id}', [RequeteController::class, 'show'])->name('requette.show');


            // Route for charges
            Route::get('gestion/charges', [GestionController::class, 'charge'])->name('gestion.index');
            Route::get('gestion/charges/load', [GestionController::class, 'loadCharges'])->name('gestion.load.charge');
            Route::post('gestion/charges/add', [GestionController::class, 'storeCharge'])->name('gestion.charge.add');
            Route::post('gestion/charges/delete', [GestionController::class, 'deleteCharge'])->name('gestion.charge.delete');

            // Route for taches
            Route::get('gestion/tasks', [GestionController::class, 'taches'])->name('gestion.tache');
            Route::get('gestion/tasks/load', [GestionController::class, 'loadTaches'])->name('gestion.load.tache');
            Route::post('gestion/tasks/add', [GestionController::class, 'storeTask'])->name('gestion.taches.add');
            Route::post('gestion/tasks/markasdone', [GestionController::class, 'markTaskAsDone'])->name('gestion.taches.markasdone');
            Route::post('gestion/tasks/delete', [GestionController::class, 'deleteTache'])->name('gestion.taches.delete');

            // Route for caisse
            Route::get('gestion/caisses', [CaisseController::class, 'index'])->name('gestion.caisses');
            Route::get('gestion/caisses/load', [CaisseController::class, 'loadCaisses'])->name('gestion.load.caisse');

            Route::post('gestion/calendar', [UserController::class, 'UpdateImage'])->name('gestion.calendrier');
            //Route for rapport
            Route::get('rapport/charge', [RapportController::class, 'showChargeForm'])->name('rapport.charge');
            Route::get('rapport/charge/print', [RapportController::class, 'printCharge'])->name('rapport.charge.print');

            //load notification
            Route::view('/notification', 'notify')->name('notify.all');


            Route::resource('personnel', \App\Http\Controllers\PersonnelsController::class);
            Route::resource('equipement', \App\Http\Controllers\EquipementsController::class);


            //Route for admin prefix with admin depend on  middleware to allow only admin
            Route::prefix('admin')->group(function () {
                Route::middleware([CheckAdmin::class])->group(function () {
                    // routes pour les compte utilisateurs
                    Route::get('user/all', [UserController::class, 'index'])->name('user.all');
                    Route::view('user/new', 'user.add')->name('user.add');
                    Route::post('user/new/store', [UserController::class, 'storeUser'])->name('user.add.store');
                    Route::get('user/edit/{id}', [UserController::class, 'editUser'])->name('user.edit');
                    Route::post('user/edit/store', [UserController::class, 'updateUser'])->name('user.edit.store');
                    Route::post('user/delete', [UserController::class, 'deleteUser'])->name('user.delete');
                    Route::get('user/activate/{id}', [UserController::class, 'activate'])->name('activate_compte');
                    Route::get('user/block/{id}', [UserController::class, 'block'])->name('block_compte');


                    Route::get('formation', [FormationsController::class, 'index'])->name('formation.index');
                    Route::get('formation/create', [FormationsController::class, 'create'])->name('formation.create');
                    Route::post('formation/store', [FormationsController::class, 'store'])->name('formation.store');
                    Route::get('formation/edit/{id}', [FormationsController::class, 'edit'])->name('formation.edit');
                    Route::post('formation/update', [FormationsController::class, 'update'])->name('formation.update');
                    Route::post('formation/delete', [FormationsController::class, 'delete'])->name('formation.delete');

                    Route::get('fournisseur', [FournisseurController::class, 'index'])->name('fournisseur.index');
                    Route::get('fournisseur/create', [FournisseurController::class, 'create'])->name('fournisseur.create');
                    Route::post('fournisseur/store', [FournisseurController::class, 'store'])->name('fournisseur.store');
                    Route::get('fournisseur/edit/{id}', [FournisseurController::class, 'edit'])->name('fournisseur.edit');
                    Route::post('fournisseur/update', [FournisseurController::class, 'update'])->name('fournisseur.update');
                    Route::post('fournisseur/delete', [FournisseurController::class, 'delete'])->name('fournisseur.delete');

                    Route::get('requette/valider/{id}', [RequeteController::class, 'valider'])->name('requette.valider');

                    Route::post('requette/valider', [RequeteController::class, 'valider2'])->name('requette.valid');
                    Route::post('requette/rejeter', [RequeteController::class, 'rejet'])->name('requette.rejet');
                    Route::get('requette/attente/{id}', [RequeteController::class, 'bloquer'])->name('requette.attente');
                    Route::get('requette/rejeter/{id}', [RequeteController::class, 'regeter'])->name('requette.rejeter');
                    Route::get('requette/print}', [RequeteController::class, 'print'])->name('requette.print');
                    Route::get('requette', [RequeteController::class, 'index'])->name('requette.index');

                });
            });


        });

    });

});
Route::get('clear', function () {
    Artisan::call('optimize');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});
