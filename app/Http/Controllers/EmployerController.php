<?php

namespace App\Http\Controllers;

use App\Models\Corps;
use App\Models\Direction;
use App\Models\Employer;
use App\Models\Fonction;
use App\Models\Grade;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployerController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $filterF= $request->filterF;
        $filterS= $request->filterS;
        $per_page = $request->per_page;
        
        $employers = Employer::with("fonction", "service.direction", "service")
        
        ->leftJoin('fonctions', 'fonctions.id', '=', 'employers.fonction_id')
        ->leftJoin('services', 'services.id', '=', 'fonctions.service_id')
        
        ->when($search, function($query) use($search){
            $query->where("nom", "like", "%${search}%");
            $query->orWhere("prenom", "like", "%${search}%");
            $query->orWhere("numero_employer", "like", "%${search}%");
        })
                
        ->when($filterF, function($query) use($filterF){
            $query->where("services.direction_id", $filterF);
            
        })
        ->when($filterS, function($query) use($filterS){
            $query->where("fonctions.service_id", "=", $filterS);
            
        })
       // ->latest()
        ->paginate($per_page ?? 10);
        $Direction = Direction::withCount('employer')->get();
        $Fonctions = Direction::all();
        $Services = Service::all();
        return inertia("Employer/Index", ["Employers"=>$employers, "Services"=>$Services,
        "Fonctions"=>$Fonctions, "Directions"=>$Direction, 
        "filtres"=>$request->all("search", "filterF", "FilterS", "per_page")
    ]);
    }

    public function create(){
        $Grades = Grade::all();
        $Corps = Corps::all();
        $Fonctions = Fonction::all();
        return inertia("Employer/Create", ["Grades"=>$Grades, "Corps"=>$Corps, "Fonctions"=>$Fonctions]);
    }

    
    public function store(Request $request){
        $validatedData = $request->validate([
            "numero_employer"=> "required|unique:App\\Models\Employer",
            "nom"=> "required",
            "prenom"=> "required",
            "sexe"=> "required",
            "date_naissance"=> "required",
            "adresse"=> "required",
            "telephone"=> "required",
            "email"=> "required",
            "grade_id"=> "required|exists:grades,id",
            "corps_id"=> "required|exists:corps,id",
            "date_embauche"=> "required",
            "fonction_id"=> "required|exists:fonctions,id"
        ]);
        try{
            DB::beginTransaction();
            $employer = Employer::create([...$validatedData]);
    
            if($request->hasFile("photo")){
                $photo = $request->photo;
                $name = $employer->nom ." ".$employer->prenom;
                $fileName = str_replace(" ", "_", $name);
                $filePath = $photo->storeAs("photos", $fileName, "public");
                $employer->photo = $filePath;
                $employer->save();
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }


        return redirect()->back();
    }

    public function edit($numeroEmployer){
        
        $employer = Employer::where('numero_employer', $numeroEmployer)->first();
        $Grades = Grade::all();
        $Corps = Corps::all();
        $Fonctions = Fonction::all();
        return inertia("Employer/Edit", ["Grades"=>$Grades, "Corps"=>$Corps, "Fonctions"=>$Fonctions, 
        "employer"=>$employer]); 
    }

    public function update(Request $request, Employer $employer){
        $validatedData = $request->validate([
            "numero_employer" =>[
                "required",
                Rule::unique((new Employer)->getTable(), "numero_employer")->ignore($employer->id)
            ],
            "nom"=> "required",
            "prenom"=> "required",
            "sexe"=> "required",
            "date_naissance"=> "required",
            "adresse"=> "required",
            "telephone"=> "required",
            "email"=> "required",
            "grade_id"=> "required|exists:grades,id",
            "corps_id"=> "required|exists:corps,id",
            "date_embauche"=> "required",
            "fonction_id"=> "required|exists:fonctions,id"
        ]);
        try{
            DB::beginTransaction();
            $employer->update([...$validatedData]);
    
            if($request->hasFile("photo")){
                $photo = $request->photo;
                $name = $employer->nom ." ".$employer->prenom;
                $fileName = str_replace(" ", "_", $name);
                $filePath = $photo->storeAs("photos", $fileName, "public");
                $employer->photo = $filePath;
                $employer->save();
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }


        return redirect()->back();
    }

    public function destroy($numeroEmployer){
        $employer = Employer::where('numero_employer', $numeroEmployer)->first(); 
        if($employer->photo){
            if(Storage::exists($employer->photo)){
                Storage::delete($employer->photo);
            }
        }
        if(count($employer->relier_evaluation)>0){
            return redirect()->back()->withErrors([
           "message" => "cet employé ne peut pas etre supprimé car il existe des évaluations qui dependent de ce dernier."
       ]);
                   
       }
       if(count($employer->relier_promotion)>0){
        return redirect()->back()->withErrors([
       "message" => "cet employé ne peut pas etre supprimé car il existe des promotions qui dependent de ce dernier."
   ]);
               
   }
        if(count($employer->rilier_experience)>0){
            return redirect()->back()->withErrors([
           "message" => "cet employé ne peut pas etre supprimé car il existe des expériences qui dependent de ce dernier."
       ]);
                   
       }
        if(count($employer->relierformation)>0){
            return redirect()->back()->withErrors([
           "message" => "cet employé ne peut pas etre supprimé car il existe des formations qui dependent de ce dernier."
       ]);
                   
       }
       if(count($employer->candidature)>0){
        return redirect()->back()->withErrors([
       "message" => "cet employé ne peut pas etre supprimé car il existe des candidats qui dependent de ce dernier."
   ]);
               
   }
        $employer->delete();
        
        return redirect()->back();
    }

    public function momba($numero){
        $employer  = Employer::with("fonction", "service.direction", "service", "grade", "corps", "rilier_experience.experience", "relierformation.formation", "relier_evaluation.evaluation")
        ->where('numero_employer', $numero)->first();
        return response()->json(["employer" => $employer]);
    }
}