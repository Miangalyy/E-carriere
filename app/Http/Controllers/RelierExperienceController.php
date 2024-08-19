<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use App\Models\Employer;
use App\Models\Experience;
use App\Models\RilierExperience;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RelierExperienceController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $per_page = $request->per_page;
         $relier = RilierExperience::with('employer', 'experience')
         ->join('employers', 'employers.id', '=', 'rilier_experiences.employer_id')
         ->join('experiences', 'experiences.id', '=', 'rilier_experiences.experience_id')
         ->when($search, function($query) use($search){
             $query->where("employers.nom", "like", "%${search}%");
             $query->orWhere("employers.prenom", "like", "%${search}%");
             $query->orWhere("employers.numero_employer", "like", "%${search}%");
             $query->orWhere("experiences.fonction", "like", "%${search}%");
             $query->orWhere("rilier_experiences.numero", "like", "%${search}%");
             $query->orWhere("rilier_experiences.nom_entreprise", "like", "%${search}%");
             
         })
         //->latest()
         ->paginate($per_page ?? 5);
         $Direction = Direction::withCount('employer')->get();
         return inertia('Competence/Experience/Relier/Index', ["relier" => $relier,"Direction"=>$Direction,
         "filtres"=>$request->all("search", "per_page") 
     ]);
     }

     public function create(){
        $Experiences = Experience::all();
        $Employers = Employer::all();
        
        return inertia('Competence/Experience/Relier/Create', ["Experiences" => $Experiences,
        "Employers"=>$Employers
        ]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            "numero" => "required|unique:App\\Models\RilierExperience",
            "experience_id" => "required|exists:experiences,id",
            "employer_id" => "required|exists:employers,id",
            "description" => "required",
            "nom_entreprise" => "required",
            "date_debut" => "required",
            "date_fin" => "required",
            
        ]);
        $relier = RilierExperience::create([...$validateData]);

        return redirect()->back();
    }

    public function edit($numero){
        $relier = RilierExperience::where("numero", "=", $numero)->first();
        $Experiences = Experience::all();
        $Employers = Employer::all();
        return inertia('Competence/Experience/Relier/Edit', ["Experiences" => $Experiences, "Employers" => $Employers,
        "relier"=>$relier
    ]);
    }

    public function update(Request $request, RilierExperience $relier){
        $validateData = $request->validate([
            "numero" =>[
                "required",
                Rule::unique((new RilierExperience)->getTable(), "numero")->ignore($relier->id)
            ],
            "experience_id" => "required|exists:experiences,id",
            "employer_id" => "required|exists:employers,id",
            "date_debut" => "required",
            "description" => "required",
            "nom_entreprise" => "required",
            "date_fin" => "required",
        ]);
        $relier->update([...$validateData]);
        return redirect()->back();
    }

    public function destroy($relier){
        $experience = RilierExperience::where('numero', '=', $relier)->first();
        $experience->delete();
        return redirect()->back();
    }
}