<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function index(){
        return Inertia::render('Login');
    }

    public function logout(){
        Auth::logout();

        return Inertia::location("/accueil");
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:4'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $defaultRoute = route("employer");
            $intended_route = redirect()->intended($defaultRoute)->getTargetUrl();
 
            return Inertia::location($intended_route);
        }
 
        return back()->withErrors([
            'email' => "Votre mot de passe est incorrecte :(",
        ]);
    
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            "name"=> "required|min:5",
            "email"=> "required",
            "numero"=> "required|exists:employers,numero_employer",
            "password"=> "required|min:4"
        ]);
      
        $verif = DB::table('employers')
        ->select('fonction_id')
        ->where('numero_employer', '=', $validatedData['numero'])
        ->first();
        if ($verif && $verif->fonction_id == 1) {
            // La requête a renvoyé des résultats
            try{

                DB::beginTransaction();
                $user = User::create([...$validatedData]);
                
                if($request->hasFile("photo")){
                    $photo = $request->photo;
                    $name = $user->name;
                    $fileName = str_replace(" ", "_", $name);
                    $filePath = $photo->storeAs("photos", $fileName, "public");
                    $user->photo = $filePath;
                    $user->save();
                    
                }
            
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
            
            // Faites quelque chose avec $fonctionId, par exemple, retournez-le ou utilisez-le de la manière souhaitée
        }
        else{
            return redirect()->back()->withErrors([
                "message" => "Vous ne pouvez pas creer un compte car vous n'etes pas Admin."
            ]);
        }

            return redirect()->back();
    }
}