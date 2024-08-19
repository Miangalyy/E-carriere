<?php

use App\Http\Controllers\DirectionController;
use App\Http\Controllers\FonctionController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\CorpsController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RelierEvaluationController;
use App\Http\Controllers\RelierExperienceController;
use App\Http\Controllers\RelierFormationController;
use App\Http\Controllers\RelierPromotionController;
use App\Http\Controllers\OpportuniteController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\AccueilController;
use App\Models\Grade;
use Illuminate\Support\Facades\Route;
//754d7249200a53
//sandbox.smtp.mailtrap.io 2525

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/accueil', [AccueilController::class, "Index"])->name("accueil");
Route::get('/accueil/poste', [AccueilController::class, "poste"])->name("accueil.poste");
Route::post('/accueil', [AccueilController::class, "store"])->name("accueil.store");

Route::get('/login', [LoginController::class, "index"])
->middleware("guest")
->name("login");
Route::post('/login', [LoginController::class, "authenticate"])
->middleware("guest")
->name("login.post");

Route::post('/login/create', [LoginController::class, "store"])->name("login.create");



Route::group([
    "middleware" => "auth"
], function(){
 Route::get('/', function () {
        return inertia('Test2');
    })->name("home");

Route::post("/logout", [LoginController::class, "logout"]);
Route::get("/card", [CardController::class, "index"])->name('card');
Route::get('/test', [TestController::class, "test"])->name("test1");
Route::post('/bar', [TestController::class, "bar"])->name("mail");
Route::get('/direction', [DirectionController::class, "index"])->name("direction");
Route::post('/direction/create', [DirectionController::class, "create"])->name("direction.create");
Route::get('/direction/edit/{direction}', [DirectionController::class, "edit"])->name("direction.edit");
Route::put('/direction/edit/{direction}', [DirectionController::class, "update"])->name("direction.update");
Route::delete("/direction/delete/{direction}", [DirectionController::class, "delete"])->name("direction.delete");
Route::get('/service', [ServiceController::class, "index"])->name("service");
Route::post('/service', [ServiceController::class, "store"])->name("service.store");
Route::get('/service/create', [ServiceController::class, "create"])->name("service.create");
Route::get('/service/edit/{service}', [ServiceController::class, "edit"])->name("service.edit");
Route::post('/service/edit/{service}', [ServiceController::class, "update"])->name("service.update");
Route::delete('/service/{service}', [ServiceController::class, "delete"])->name("service.delete");
Route::get('/poste', [PosteController::class, "index"])->name("poste");
Route::get('/fonction', [FonctionController::class, "index"])->name("fonction");
Route::post('/fonction', [FonctionController::class, "store"])->name("fonction.store");
Route::get('/fonction/create', [FonctionController::class, "create"])->name("fonction.create");
Route::get('/fonction/edit/{fonction}', [FonctionController::class, "edit"])->name("fonction.edit");
Route::put('/fonction/{fonction}', [FonctionController::class, "update"])->name("fonction.update");
Route::delete('/fonction/{fonction}', [FonctionController::class, "delete"])->name("fonction.delete");

Route::get('/experience', [ExperienceController::class, "index"])->name("experience");
Route::post('/experience', [ExperienceController::class, "create"])->name("experience.create");
Route::get('/experience/edit/{experience}', [ExperienceController::class, "edit"])->name("experience.edit");
Route::put('/experience/{experience}', [ExperienceController::class, "update"])->name("experience.update");
Route::delete('/experience/{experience}', [ExperienceController::class, "delete"])->name("experience.delete");


Route::get('/formation', [FormationController::class, "index"])->name("formation");
Route::post('/formation', [FormationController::class, "create"])->name("formation.create");
Route::get('/formation/edit/{formation}', [FormationController::class, "edit"])->name("formation.edit");
Route::put('/formation/{formation}', [FormationController::class, "update"])->name("formation.update");
Route::delete('/formation/{formation}', [FormationController::class, "delete"])->name("formation.delete");


Route::get('/grade', [GradeController::class, "index"])->name("grade");
Route::post('/grade', [GradeController::class, "create"])->name("grade.create");
Route::get('/grade/edit/{grade}', [GradeController::class, "edit"])->name("grade.edit");
Route::put('/grade/{grade}', [GradeController::class, "update"])->name("grade.update");
Route::delete('/grade/{grade}', [GradeController::class, "delete"])->name("grade.delete");


Route::get('/corps', [CorpsController::class, "index"])->name("corps");
Route::post('/corps', [CorpsController::class, "create"])->name("corps.create");
Route::post('/corps', [CorpsController::class, "create"])->name("corps.create");
Route::get('/corps/edit/{corps}', [CorpsController::class, "edit"])->name("corps.edit");
Route::put('/corps/{corps}', [CorpsController::class, "update"])->name("corps.update");
Route::delete('/corps/{corps}', [CorpsController::class, "delete"])->name("corps.delete");



Route::get('/employer', [EmployerController::class, "index"])->name("employer");
Route::get('/employer/vue/{numero}', [EmployerController::class, "momba"])->name("employer.momba");
Route::post('/employer', [EmployerController::class, "store"])->name("employer.store");
Route::get('/employer/create', [EmployerController::class, "create"])->name("employer.create");
Route::get('/employer/edit/{numeroEmployer}', [EmployerController::class, "edit"])->name("employer.edit");
Route::post('/employer/{employer}', [EmployerController::class, "update"])->name("employer.update");
Route::delete('/employer/{numeroEmployer}', [EmployerController::class, "destroy"])->name("employer.delete");


Route::get('/expemple', [RelierExperienceController::class, "index"])->name("expemple");
Route::post('/expemple', [RelierExperienceController::class, "store"])->name("expemple.store");
Route::get('/expemple/create', [RelierExperienceController::class, "create"])->name("expemple.create");
Route::get('/expemple/edit/{relier}', [RelierExperienceController::class, "edit"])->name("expemple.edit");
Route::put('/expemple/{relier}', [RelierExperienceController::class, "update"])->name("expemple.update");
Route::delete('/expemple/{relier}', [RelierExperienceController::class, "destroy"])->name("expemple.delete");

Route::get('/formemple', [RelierFormationController::class, "index"])->name("formemple");
Route::get('/formemple/create', [RelierFormationController::class, "create"])->name("formemple.create");
Route::post('/formemple', [RelierFormationController::class, "store"])->name("formemple.store");
Route::get('/formemple/edit/{relier}', [RelierFormationController::class, "edit"])->name("formemple.edit");
Route::put('/formemple/{relier}', [RelierFormationController::class, "update"])->name("formemple.update");
Route::delete('/formemple/{relier}', [RelierFormationController::class, "destroy"])->name("formemple.delete");

Route::get('/evaluation', [EvaluationController::class, "index"])->name("evaluation");
Route::post('/evaluation', [EvaluationController::class, "create"])->name("evaluation.create");
Route::get('/evaluation/edit/{evaluation}', [EvaluationController::class, "edit"])->name("evaluation.edit");
Route::put('/evaluation/{evaluation}', [EvaluationController::class, "update"])->name("evaluation.update");
Route::delete('/evaluation/{evaluation}', [EvaluationController::class, "delete"])->name("evaluation.delete");



Route::get('/promotion', [PromotionController::class, "index"])->name("promotion");
Route::get('/promotion/create', [PromotionController::class, "create"])->name("promotion.create");
Route::post('/promotion', [PromotionController::class, "store"])->name("promotion.store");
Route::get('/promotion/edit/{promotion}', [PromotionController::class, "edit"])->name("promotion.edit");
Route::put('/promotion/{promotion}', [PromotionController::class, "update"])->name("promotion.update");
Route::delete('/promotion/{promotion}', [PromotionController::class, "delete"])->name("promotion.delete");



Route::get('/evalemple', [RelierEvaluationController::class, "index"])->name("evalemple");
Route::get('/evalemple/create', [RelierEvaluationController::class, "create"])->name("evalemple.create");
Route::post('/evalemple', [RelierEvaluationController::class, "store"])->name("evalemple.store");
Route::get('/evalemple/edit/{relier}', [RelierEvaluationController::class, "edit"])->name("evalemple.edit");
Route::put('/evalemple/{relier}', [RelierEvaluationController::class, "update"])->name("evalemple.update");
Route::delete('/evalemple/{relier}', [RelierEvaluationController::class, "destroy"])->name("evalemple.delete");



Route::get('/promemple', [RelierPromotionController::class, "index"])->name("promemple");
Route::get('/promemple/create', [RelierPromotionController::class, "create"])->name("promemple.create");
Route::post('/promemple', [RelierPromotionController::class, "store"])->name("promemple.store");
Route::get('/promemple/edit/{relier}', [RelierPromotionController::class, "edit"])->name("promemple.edit");
Route::put('/promemple/{relier}', [RelierPromotionController::class, "update"])->name("promemple.update");
Route::delete('/promemple/{relier}', [RelierPromotionController::class, "destroy"])->name("promemple.delete");



Route::get('/opportunite', [OpportuniteController::class, "index"])->name("opportunite");
Route::post('/opportunite', [OpportuniteController::class, "create"])->name("opportunite.create");
Route::get('/opportunite/edit/{opportunite}', [OpportuniteController::class, "edit"])->name("opportunite.edit");
Route::put('/opportunite/{opportunite}', [OpportuniteController::class, "update"])->name("opportunite.update");
Route::delete('/opportunite/{opportunite}', [OpportuniteController::class, "delete"])->name("opportunite.delete");



Route::get('/candidat', [CandidatureController::class, "index"])->name("candidat");
Route::get('/candidat/create', [CandidatureController::class, "create"])->name("candidat.create");
Route::post('/candidat', [CandidatureController::class, "store"])->name("candidat.store");
Route::get('/candidat/edit/{relier}', [CandidatureController::class, "edit"])->name("candidat.edit");
Route::put('/candidat/{relier}', [CandidatureController::class, "update"])->name("candidat.update");
Route::delete('/candidat/{relier}', [CandidatureController::class, "destroy"])->name("candidat.delete");
    
});