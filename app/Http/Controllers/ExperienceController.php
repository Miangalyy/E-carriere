<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExperienceController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $per_page = $request->per_page;
        $Experiences = Experience::orderBy('id', 'ASC')
        ->when($search, function($query) use($search){
            $query->where("fonction", "like", "%${search}%");
            
            
        })
        ->paginate($per_page ?? 5);
        $Direction = Direction::withCount('employer')->get();
        return inertia('Competence/Experience/Index', ["Experiences" => $Experiences, "Direction" =>$Direction,
        "filtres"=>$request->all("search", "per_page") 
    ]);
    }

    public function create(Request $request){
        $request->validate([
        "fonction" => "required|unique:App\\Models\Experience"
        
    ]);
    Experience::create([
     'fonction' => $request->fonction
    ]);
    return redirect()->back();
    }

    public function edit(Experience $experience){
        return response()->json(["experience" => $experience]);
    }

    public function update(Request $request, Experience $experience){
          $request->validate([
          "fonction" =>[
                "required",
                 Rule::unique((new Experience)->getTable(), "fonction")->ignore($experience->id)
          ],
    
         ]);

                $experience->fonction = $request->fonction;
                $experience->save();
            

            return redirect()->back();
            }
    public function delete(Experience $experience){
        if(count($experience->rilier_experience)>0){
             return redirect()->back()->withErrors([
            "message" => "cette expérience ne peut pas etre supprimé car il existe des employés qui dependent de ce dernier."
       ]);
                    
       }
         $experience->delete();
         return redirect()->back();
    }
    
}