<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class EvaluationController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $per_page = $request->per_page;
        $Evaluation = Evaluation::orderBy('id', 'ASC')
        ->when($search, function($query) use($search){
            $query->where("titre", "like", "%${search}%");  
            
        })
        ->paginate($per_page ?? 5);
        $Evaluations  = DB::table('relier_evaluations')
        ->leftJoin('employers', 'employers.id', '=', 'relier_evaluations.employer_id')
        ->select('date',DB::raw('COUNT(DISTINCT employer_id) as nombre'),)
        ->groupBy('date')
        ->get();
        return inertia('Evaluation/Index', ["Evaluations" => $Evaluation,"Evaluation"=>$Evaluations,
        "filtres"=>$request->all("search", "per_page") 
    ]);
    }

    public function create(Request $request){
        $request->validate(["titre" => "required|unique:App\\Models\Evaluation"
        
    ]);
    Evaluation::create(['titre' => $request->titre
    ]);
    return redirect()->back();
    }

    public function edit(Evaluation $evaluation){
        return response()->json(["evaluation" => $evaluation]);
    }

    public function update(Request $request, Evaluation $evaluation){
        $request->validate([ "titre" =>[
            "required",
            Rule::unique((new Evaluation)->getTable(), "titre")->ignore($evaluation->id)
        ],
  
       ]);

         
              $evaluation->titre = $request->titre;
              $evaluation->save();
          

          return redirect()->back();
          }

          public function delete(Evaluation $evaluation){
             if(count($evaluation->relier_evaluation)>0){
                  return redirect()->back()->withErrors([
                 "message" => "cette évaluation ne peut pas etre supprimé car il existe des employés qui dependent de ce dernier."
             ]);
                         
             }
              $evaluation->delete();
              return redirect()->back();
         }
}