<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DirectionController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $per_page = $request->per_page;
        $Directions = Direction::orderBy('id', 'ASC')
        ->when($search, function($query) use($search){
            $query->where("numero_direction", "like", "%${search}%");
            $query->orWhere("titre", "like", "%${search}%");
            $query->orWhere("responsable", "like", "%${search}%");
            
        })
        ->paginate(5);
        $Direction = Direction::withCount('employer')->get();
        return inertia('Departement/Direction/Index', ["Directions" => $Directions, "Direction"=>$Direction,
        "filtres"=>$request->all("search", "per_page") 
    ]);
    }
    
    public function create(Request $request){
        $request->validate(["numero_direction" => "required|unique:App\\Models\Direction",
        "res" => "required",
        "title" => "required",
        "description" => "required"
        
    ]);
    Direction::create(['numero_direction' => $request->numero_direction, 'responsable' => $request->res,
     'titre' => $request->title, 'description' => $request->description
    ]);
    return redirect()->back();
    }

    public function edit(Direction $direction){
        return response()->json(["direction" => $direction]);
    }

    public function update(Request $request, Direction $direction){
        $request->validate([
            "numero_direction" =>[
                "required",
                Rule::unique((new Direction)->getTable(), "numero_direction")->ignore($direction->id)
            ],
            "responsable" => "required",
            "titre" => "required",
            "description" => "required",
            ]);

           
                $direction->numero_direction = $request->numero_direction;
                $direction->responsable = $request->responsable;
                $direction->titre = $request->titre;
                $direction->description = $request->description;
                $direction->save();
            

            return redirect()->back();
    }
    
    public function delete(Direction $direction){
        if(count($direction->service)>0){
            return redirect()->back()->withErrors([
                "message" => "ce direction ne peut pas etre supprimé car il existe des services qui dependent de ce dernier."
            ]);
            
        }
        $direction->delete();
        return redirect()->back();
    }
    
}