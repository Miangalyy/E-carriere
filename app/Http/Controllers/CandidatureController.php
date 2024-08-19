<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Employer;
use App\Models\Opportunite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CandidatureController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $filter= $request->filter;
        $filterStatut = $request->filterstatut;
        $per_page = $request->per_page;
         $Candidats = Candidature::with('employer', 'opportunite')
         ->leftJoin('employers', 'employers.id', '=', 'candidatures.employer_id')
         ->when($search, function($query) use($search){
             $query->where("employers.nom", "like", "%${search}%");
             $query->orWhere("employers.prenom", "like", "%${search}%");
             $query->orWhere("employers.numero_employer", "like", "%${search}%");
             $query->orWhere("candidatures.date", "like", "%${search}%");
             
         })
         ->when($filter, function($query) use($filter){
             $query->where("opportunite_id", $filter);
             
         })
         ->when($filterStatut, function($query) use($filterStatut){
            $query->where("statut", $filterStatut);
            
        })
        // ->latest()
         ->paginate($per_page ?? 5);
         
         $opportunites  = Opportunite::all();
         $evaluation = DB::table('candidatures')
         ->select('date', DB::raw('COUNT(DISTINCT employer_id) as nombre'),)
         ->groupBy('date')
         ->get();
         return inertia('Candidature/Index', ["Candidats" => $Candidats,
         "Opportunites" => $opportunites,"Evaluation"=>$evaluation,
         "filtres"=>$request->all("search", "per_page", "filter", "filterstatut") 
     ]);
     }

     public function create(){
        $opportunites = Opportunite::all();
        $Employers = Employer::all();
        
        return inertia('Candidature/Create', ["Opportunites" => $opportunites,
        "Employers"=>$Employers
        ]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            "numero" => "required|unique:App\\Models\Candidature",
            "employer_id" => "required|exists:employers,id",
            "opportunite_id" => "required|exists:opportunites,id",
            "statut" => "required",
            "date" => "required",
            
        ]);
        $relier = Candidature::create([...$validateData]);

        return redirect()->back();
    }

        public function edit($numero){
        $relier = Candidature::where("numero", "=", $numero)->first();
        $Evaluations = Opportunite::all();
        $Employers = Employer::all();
        return inertia('Candidature/Edit', ["Opportunites" => $Evaluations, "Employers" => $Employers,
        "relier"=>$relier
    ]);
    }

    public function update(Request $request, Candidature $relier){
        $validateData = $request->validate([
            "numero" =>[
                "required",
                Rule::unique((new Candidature)->getTable(), "numero")->ignore($relier->id)
            ],
            "opportunite_id" => "required|exists:opportunites,id",
            "employer_id" => "required|exists:employers,id",
            "statut" => "required",
            "date" => "required",
        ]);
        $relier->update([...$validateData]);
        return redirect()->back();
    }

    public function destroy($relier){
        $experience = Candidature::where('numero', '=', $relier)->first();
        $experience->delete();
        return redirect()->back();
    }
}