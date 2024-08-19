<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Formation;
use App\Models\relierformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RelierFormationController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $per_page = $request->per_page;
         $relier = relierformation::with('employer','formation')
         ->join('employers', 'employers.id', '=', 'relierformations.employer_id')
         ->when($search, function($query) use($search){
             $query->where("employers.nom", "like", "%${search}%");
             $query->orWhere("employers.prenom", "like", "%${search}%");
             $query->orWhere("employers.numero_employer", "like", "%${search}%");
             $query->orWhere("relierformations.numero", "like", "%${search}%");
             
         })
         //->latest()
         ->paginate($per_page ?? 5);
        $Evaluations  = DB::table('relierformations')
        ->leftJoin('employers', 'employers.id', '=', 'relierformations.employer_id')
        ->select('date_debut',DB::raw('COUNT(DISTINCT employer_id) as nombre'),)
        ->groupBy('date_debut')
        ->get();
         return inertia('Competence/Formation/Relier/Index', ["relier" => $relier,"Evaluation"=>$Evaluations,
         "filtres"=>$request->all("search", "per_page") 
     ]);
     }

     public function create(){
        $Formations = Formation::all();
        $Employers = Employer::all();
        
        return inertia('Competence/Formation/Relier/Create', ["Formations" => $Formations,
        "Employers"=>$Employers
        ]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            "numero" => "required|unique:App\\Models\\relierformation",
            "formation_id" => "required|exists:formations,id",
            "employer_id" => "required|exists:employers,id",
            "date_debut" => "required",
            "date_fin" => "required",
            
        ]);
        $relier = relierformation::create([...$validateData]);

        return redirect()->back();
    }

    public function edit($numero){
        $relier = relierformation::where("numero", "=", $numero)->first();
        $Formations = Formation::all();
        $Employers = Employer::all();
        return inertia('Competence/Formation/Relier/Edit', ["Formations" => $Formations, "Employers" => $Employers,
        "relier"=>$relier
    ]);
    }

    public function update(Request $request, relierformation $relier){
        $validateData = $request->validate([
            "numero" =>[
                "required",
                Rule::unique((new relierformation)->getTable(), "numero")->ignore($relier->id)
            ],
            "formation_id" => "required|exists:formations,id",
            "employer_id" => "required|exists:employers,id",
            "date_debut" => "required",
            "date_fin" => "required",
        ]);
        $relier->update([...$validateData]);
        return redirect()->back();
    }

    public function destroy($relier){
        $experience = relierformation::where('numero', '=', $relier)->first();
        $experience->delete();
        return redirect()->back();
    }
}