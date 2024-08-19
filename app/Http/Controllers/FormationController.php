<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormationController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $per_page = $request->per_page;
        $Formations = Formation::orderBy('id', 'ASC')
        ->when($search, function($query) use($search){
            $query->where("nom_formation", "like", "%${search}%");
            $query->orWhere("organisme_formation", "like", "%${search}%");
            
            
        })
        ->paginate($per_page ?? 5);
        $Evaluations  = DB::table('relierformations')
        ->leftJoin('employers', 'employers.id', '=', 'relierformations.employer_id')
        ->select('date_debut',DB::raw('COUNT(DISTINCT employer_id) as nombre'),)
        ->groupBy('date_debut')
        ->get();
        return inertia('Competence/Formation/Index', ["Formations" => $Formations,"Evaluation"=>$Evaluations,
        "filtres"=>$request->all("search", "per_page") 
    ]);
    }

    public function create(Request $request){
        $request->validate(["nom_formation" => "required",
        "organisme_formation" => "required",
        "description" => "required"
        
    ]);
    Formation::create(['nom_formation' => $request->nom_formation,
     'organisme_formation' => $request->organisme_formation, 'description' => $request->description
    ]);
    return redirect()->back();
    }

    public function edit(Formation $formation){
        return response()->json(["formation" => $formation]);
    }

    public function update(Request $request, Formation $formation){
        $request->validate(["nom_formation" => "required",
       "organisme_formation" => "required",
       "description" => "required"
  
       ]);

         
              $formation->nom_formation = $request->nom_formation;
              $formation->organisme_formation = $request->organisme_formation;
              $formation->description = $request->description;
              $formation->save();
          

          return redirect()->back();
          }
          
          public function delete(Formation $formation){
             if(count($formation->relierformation)>0){
               return redirect()->back()->withErrors([
                 "message" => "cette formation ne peut pas etre supprimé car il existe des employés qui dependent de ce dernier."
             ]);
                         
             }
              $formation->delete();
              return redirect()->back();
         }
}