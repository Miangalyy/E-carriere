<?php

namespace App\Http\Controllers;

use App\Models\Opportunite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OpportuniteController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $per_page = $request->per_page;
        $Opportunite = Opportunite::orderBy('id', 'ASC')
        ->when($search, function($query) use($search){
            $query->where("titre", "like", "%${search}%");
            
            
        })
        ->paginate($per_page ?? 5);
       /* $Direction = Opportunite::selectRaw('id, DATE(date) as date_opp, titre')
        ->withCount('candidature')
        ->get()
        ->groupBy('date_opp');*/
        $Direction = DB::table('opportunites')
        ->leftJoin('candidatures', 'candidatures.opportunite_id', '=', 'opportunites.id')
        ->select('opportunites.titre as titre', 'opportunites.date as datee',DB::raw('COUNT(opportunites.date) as nombre'),)
        ->groupBy('datee', 'titre')
        ->get();
        return inertia('Opportunite/Index', ["Opportunites" => $Opportunite,"Direction"=>$Direction,
        "filtres"=>$request->all("search", "per_page") 
    ]);
    }

    public function create(Request $request){
        $request->validate(["titre" => "required",
        "description" => "required",
        "competence" => "required",
        "date" => "required",
        
    ]);
    Opportunite::create(['titre' => $request->titre,
     'description' => $request->description, 'competence' => $request->competence, 'date' => $request->date
    ]);
    return redirect()->back();
    }

    public function edit(Opportunite $Opportunite){
        return response()->json(["opportunite" => $Opportunite]);
    }

    public function update(Request $request, Opportunite $opportunite){
        $request->validate(["titre" => "required",
       "competence" => "required",
       "description" => "required",
       "date" => "required"
  
       ]);

         
              $opportunite->titre = $request->titre;
              $opportunite->competence = $request->competence;
              $opportunite->description = $request->description;
              $opportunite->date = $request->date;
              $opportunite->save();
          

          return redirect()->back();
          }

          public function delete(Opportunite $opportunite){
             if(count($opportunite->candidature)>0){
                  return redirect()->back()->withErrors([
                 "message" => "cet opportunité ne peut pas etre supprimé car il existe des candidats qui dependent de ce dernier."
             ]);
                         
             }
              $opportunite->delete();
              return redirect()->back();
         }
}