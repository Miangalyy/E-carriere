<?php

namespace App\Http\Controllers;

use App\Models\Fonction;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FonctionController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $filter= $request->filter;
        $per_page = $request->per_page;
         $Fonctions = Fonction::with('service')
         ->when($search, function($query) use($search){
             $query->where("numero_fonction", "like", "%${search}%");
             $query->orWhere("titre", "like", "%${search}%");
             
             
         })
         ->when($filter, function($query) use($filter){
             $query->where("service_id", $filter);
             
         })
         ->latest()
         ->paginate($per_page ?? 5);
         $Services  = Service::all();
         $Direction = Fonction::withCount('employer')->get();
         return inertia('Departement/Fonction/Index', ["Fonctions" => $Fonctions,
         "Services" => $Services,"Direction"=>$Direction,
         "filtres"=>$request->all("search", "per_page", "filter") 
     ]);
    }

    public function create(Request $request){
        $Services = Service::all();
        
        return inertia('Departement/Fonction/Create', ["Services" => $Services]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            "numero_fonction" => "required|unique:App\\Models\Fonction",
            "service_id" => "required|exists:services,id",
            "titre" => "required",
            "description" => "required",
            
        ]);
        $fonction = Fonction::create([...$validateData]);

        return redirect()->back();
    }

      public function edit(Fonction $fonction){
        $Services = Service::all();
        return inertia('Departement/Fonction/Edit', ["Services" => $Services, "Fonctions" => $fonction]);
    }

    public function update(Request $request, Fonction $fonction){
        $validateData = $request->validate([
            "numero_fonction" =>[
                "required",
                Rule::unique((new Fonction)->getTable(), "numero_fonction")->ignore($fonction->id)
            ],
            "service_id" => "required|exists:services,id",
            "titre" => "required",
            "description" => "required",
        ]);
        $fonction->update([...$validateData]);
        return redirect()->back();
    }

    public function delete(Fonction $fonction){
        if(count($fonction->employer)>0){
            return redirect()->back()->withErrors([
                "message" => "ce fonction ne peut pas etre supprimé car il existe des employés qui dependent de ce dernier."
            ]);
            
        }
        $fonction->delete();
        return redirect()->back();
    }
}