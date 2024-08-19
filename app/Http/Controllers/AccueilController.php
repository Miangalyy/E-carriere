<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Employer;
use App\Models\Opportunite;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function index(){
        $opportunite = Opportunite::orderBy('date', 'DESC')
        ->get();
        return inertia('Accueil', ["opportunite"=>$opportunite]);
    }
    
    public function poste(){
        $employes = Employer::orderBy('id', 'DESC')
        ->get();

        return response()->json(["employes" => $employes]);
        
    }

    public function store(Request $request){
        $request->validate(["idEmploye" => "required",
        "date" => "required",
        "idOpportunite" => "required",
        "statut" => "required",
        
    ]);
    Candidature::create(['employer_id' => $request->idEmploye,
     'date' => $request->date, 'opportunite_id' => $request->idOpportunite, 'statut' => $request->statut
    ]);
    return redirect()->back();
    }
}