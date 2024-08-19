<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Promotion;
use App\Models\RelierPromotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RelierPromotionController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $per_page = $request->per_page;
         $relier = RelierPromotion::with('employer', 'promotion')
         ->join('employers', 'employers.id', '=', 'relier_promotions.employer_id')
         ->when($search, function($query) use($search){
             $query->where("employers.nom", "like", "%${search}%");
             $query->orWhere("employers.prenom", "like", "%${search}%");
             $query->orWhere("employers.numero_employer", "like", "%${search}%");
             $query->orWhere("relier_promotions.numero", "like", "%${search}%");
             
         })
         //->latest()
         ->paginate($per_page ?? 5);
         $Evaluations  = DB::table('relier_promotions')
         ->leftJoin('employers', 'employers.id', '=', 'relier_promotions.employer_id')
         ->select('date',DB::raw('COUNT(DISTINCT employer_id) as nombre'),)
         ->groupBy('date')
         ->get();
         return inertia('Promotion/Relier/Index', ["relier" => $relier,"Evaluation"=>$Evaluations,
         "filtres"=>$request->all("search", "per_page") 
     ]);
     }

     public function create(){
        $Promotions = Promotion::all();
        $Employers = Employer::all();
        
        return inertia('Promotion/Relier/Create', ["Promotions" => $Promotions,
        "Employers"=>$Employers
        ]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            "numero" => "required|unique:App\\Models\RelierPromotion",
            "employer_id" => "required|exists:employers,id",
            "promotion_id" => "required|exists:promotions,id",
            "motif" => "required",
            "date" => "required",
            
        ]);
        $relier = RelierPromotion::create([...$validateData]);

        return redirect()->back();
    }

    public function edit($numero){
        $relier = RelierPromotion::where("numero", "=", $numero)->first();
        $Promotions = Promotion::all();
        $Employers = Employer::all();
        return inertia('Promotion/Relier/Edit', ["Promotions" => $Promotions, "Employers" => $Employers,
        "relier"=>$relier
    ]);
    }

    public function update(Request $request, RelierPromotion $relier){
        $validateData = $request->validate([
            "numero" =>[
                "required",
                Rule::unique((new RelierPromotion)->getTable(), "numero")->ignore($relier->id)
            ],
            "promotion_id" => "required|exists:promotions,id",
            "employer_id" => "required|exists:employers,id",
            "motif" => "required",
            "date" => "required",
        ]);
        $relier->update([...$validateData]);
        return redirect()->back();
    }

    public function destroy($relier){
        $experience = RelierPromotion::where('numero', '=', $relier)->first();
        $experience->delete();
        return redirect()->back();
    }
}