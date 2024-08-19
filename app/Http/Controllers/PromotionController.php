<?php

namespace App\Http\Controllers;

use App\Models\Fonction;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PromotionController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $per_page = $request->per_page;
         $Promotions = Promotion::
         when($search, function($query) use($search){
             $query->where("titre", "like", "%${search}%");
             
         })

         ->latest()
         ->paginate($per_page ?? 5);
         $Evaluations  = DB::table('relier_promotions')
         ->leftJoin('employers', 'employers.id', '=', 'relier_promotions.employer_id')
         ->select('date',DB::raw('COUNT(DISTINCT employer_id) as nombre'),)
         ->groupBy('date')
         ->get();
         return inertia('Promotion/Index', ["Promotions" => $Promotions,"Evaluation"=>$Evaluations,
         "filtres"=>$request->all("search", "per_page") 
     ]);
     }

     public function create(){
        $Fonctions = Fonction::all();
        
        return inertia('Promotion/Create', ["Fonctions" => $Fonctions]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            "titre" => "required|unique:App\\Models\Promotion",
            "nv_fonction_id" => "required|exists:fonctions,numero_fonction",
            "an_fonction_id" => "required|exists:fonctions,numero_fonction",
            
        ]);
        $promotion = Promotion::create([...$validateData]);

        return redirect()->back();
    }

    public function edit(Promotion $promotion){
        $Fonctions = Fonction::all();
        return inertia('Promotion/Edit', ["Fonctions" => $Fonctions, "Promotions" => $promotion]);
    }

    public function update(Request $request, Promotion $promotion){
        $validateData = $request->validate([
            "titre" =>[
                "required",
                Rule::unique((new Promotion)->getTable(), "titre")->ignore($promotion->id)
            ],
            "nv_fonction_id" => "required|exists:fonctions,numero_fonction",
            "an_fonction_id" => "required|exists:fonctions,numero_fonction"
        ]);
        $promotion->update([...$validateData]);
        return redirect()->back();
    }

    public function delete(Promotion $promotion){
         if(count($promotion->relier_promotion)>0){
              return redirect()->back()->withErrors([
             "message" => "cette promotion ne peut pas etre supprimé car il existe des employés qui dependent de ce dernier."
         ]);
                     
         }
          $promotion->delete();
          return redirect()->back();
     }
}