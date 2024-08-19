<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GradeController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $per_page = $request->per_page;
        $Grades = Grade::orderBy('id', 'ASC')
        ->when($search, function($query) use($search){
            $query->where("numero_grade", "like", "%${search}%");
            $query->orWhere("titre", "like", "%${search}%");
            
            
        })
        ->paginate($per_page ?? 5);
        $Direction = Grade::withCount('employer')->get();
        return inertia('Grade/Gradee/Index', ["Grades" => $Grades, "Direction"=>$Direction,
        "filtres"=>$request->all("search", "per_page") 
    ]);
    }

    public function create(Request $request){
        $request->validate(["numero_grade" => "required|unique:App\\Models\Grade",
        "title" => "required",
        "description" => "required"
        
    ]);
    Grade::create(['numero_grade' => $request->numero_grade,
     'titre' => $request->title, 'description' => $request->description
    ]);
    return redirect()->back();
    }

    public function edit(Grade $grade){
        return response()->json(["grade" => $grade]);
    }

    public function update(Request $request, Grade $grade){
        $request->validate([
            "numero_grade" =>[
                "required",
                Rule::unique((new Grade)->getTable(), "numero_grade")->ignore($grade->id)
            ],
            "titre" => "required",
            "description" => "required",
            ]);

           
                $grade->numero_grade = $request->numero_grade;
                $grade->titre = $request->titre;
                $grade->description = $request->description;
                $grade->save();
            

            return redirect()->back();
    }

    public function delete(Grade $grade){
        if(count($grade->employer)>0){
            return redirect()->back()->withErrors([
                "message" => "ce grade ne peut pas etre supprimé car il existe des employés qui dependent de ce dernier."
            ]);
            
        }
        $grade->delete();
        return redirect()->back();
    }
}