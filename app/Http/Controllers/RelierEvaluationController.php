<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Evaluation;
use App\Models\RelierEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RelierEvaluationController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $per_page = $request->per_page;
         $relier = RelierEvaluation::with('employer', 'evaluation')
         ->join('employers', 'employers.id', '=', 'relier_evaluations.employer_id')
         ->join('evaluations', 'evaluations.id', '=', 'relier_evaluations.evaluation_id')
         ->when($search, function($query) use($search){
             $query->where("employers.nom", "like", "%${search}%");
             $query->orWhere("employers.prenom", "like", "%${search}%");
             $query->orWhere("employers.numero_employer", "like", "%${search}%");
             $query->orWhere("relier_evaluations.numero", "like", "%${search}%");
             $query->orWhere("evaluations.titre", "like", "%${search}%");
             
         })
         //->latest()
         ->paginate($per_page ?? 5);
         $Evaluations  = DB::table('relier_evaluations')
         ->leftJoin('employers', 'employers.id', '=', 'relier_evaluations.employer_id')
         ->select('date',DB::raw('COUNT(DISTINCT employer_id) as nombre'),)
         ->groupBy('date')
         ->get();
         return inertia('Evaluation/Relier/Index', ["relier" => $relier,"Evaluation"=>$Evaluations,
         "filtres"=>$request->all("search", "per_page") 
     ]);
     }

     public function create(){
        $Evaluations = Evaluation::all();
        $Employers = Employer::all();
        
        return inertia('Evaluation/Relier/Create', ["Evaluations" => $Evaluations,
        "Employers"=>$Employers
        ]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            "numero" => "required|unique:App\\Models\RelierEvaluation",
            "employer_id" => "required|exists:employers,id",
            "evaluation_id" => "required|exists:evaluations,id",
            "commentaire" => "required",
            "date" => "required",
            
        ]);
        $relier = RelierEvaluation::create([...$validateData]);

        return redirect()->back();
    }

    public function edit($numero){
        $relier = RelierEvaluation::where("numero", "=", $numero)->first();
        $Evaluations = Evaluation::all();
        $Employers = Employer::all();
        return inertia('Evaluation/Relier/Edit', ["Evaluations" => $Evaluations, "Employers" => $Employers,
        "relier"=>$relier
    ]);
    }

    public function update(Request $request, RelierEvaluation $relier){
        $validateData = $request->validate([
            "numero" =>[
                "required",
                Rule::unique((new RelierEvaluation)->getTable(), "numero")->ignore($relier->id)
            ],
            "evaluation_id" => "required|exists:evaluations,id",
            "employer_id" => "required|exists:employers,id",
            "commentaire" => "required",
            "date" => "required",
        ]);
        $relier->update([...$validateData]);
        return redirect()->back();
    }

    public function destroy($relier){
        $experience = RelierEvaluation::where('numero', '=', $relier)->first();
        $experience->delete();
        return redirect()->back();
    }
}