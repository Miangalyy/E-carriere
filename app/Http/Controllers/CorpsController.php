<?php

namespace App\Http\Controllers;

use App\Models\Corps;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CorpsController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $per_page = $request->per_page;
        $Corps = Corps::orderBy('id', 'ASC')
        ->when($search, function($query) use($search){
            $query->where("numero_corps", "like", "%${search}%");
            $query->orWhere("titre", "like", "%${search}%");
            
            
        })
        ->paginate($per_page ?? 5);
        $Direction = Corps::withCount('employer')->get();
        return inertia('Grade/Corps/Index', ["Corps" => $Corps, "Direction"=>$Direction,
        "filtres"=>$request->all("search", "per_page") 
    ]);
    }

    public function create(Request $request){
        $request->validate(["numero_corps" => "required|unique:App\\Models\Corps",
        "title" => "required",
        "description" => "required"
        
    ]);
    Corps::create(['numero_corps' => $request->numero_corps,
    'titre' => $request->title, 'description' => $request->description
   ]);
   return redirect()->back();
}

public function edit(Corps $corps){
    return response()->json(["corps" => $corps]);
}

public function update(Request $request, Corps $corps){
    $request->validate([
        "numero_corps" =>[
            "required",
            Rule::unique((new Corps)->getTable(), "numero_corps")->ignore($corps->id)
        ],
        "titre" => "required",
        "description" => "required",
        ]);

       
            $corps->numero_corps = $request->numero_corps;
            $corps->titre = $request->titre;
            $corps->description = $request->description;
            $corps->save();
        

        return redirect()->back();
  }

  public function delete(Corps $corps){
     if(count($corps->employer)>0){
         return redirect()->back()->withErrors([
             "message" => "ce corps ne peut pas etre supprimé car il existe des employés qui dependent de ce dernier."
         ]);
         
     }
     $corps->delete();
     return redirect()->back();
 }
}