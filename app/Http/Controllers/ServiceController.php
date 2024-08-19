<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use App\Models\Service;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public function index(Request $request){
       $search = $request->search;
       $filter= $request->filter;
       $per_page = $request->per_page;
        $Services = Service::with('direction')
        ->when($search, function($query) use($search){
            $query->where("numero_service", "like", "%${search}%");
            $query->orWhere("titre", "like", "%${search}%");
            $query->orWhere("responsable", "like", "%${search}%");
            
        })
        ->when($filter, function($query) use($filter){
            $query->where("direction_id", $filter);
            
        })
        ->latest()
        ->paginate($per_page ?? 5);
        $Directions  = Direction::all();
        $Direction = Service::withCount('employer')->get();
        return inertia('Departement/Service/Index', ["Services" => $Services,
        "Directions" => $Directions,"Direction"=>$Direction,
        "filtres"=>$request->all("search", "per_page", "filter") 
    ]);
    }

    public function create(){
        $Directions = Direction::all();
        
        return inertia('Departement/Service/Create', ["Directions" => $Directions]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            "numero_service" => "required|unique:App\\Models\Service",
            "responsable" => "required",
            "direction_id" => "required|exists:directions,id",
            "titre" => "required",
            "description" => "required",
            
        ]);
        $service = Service::create([...$validateData]);

        return redirect()->back();
    }

    public function edit(Service $service){
        $Directions = Direction::all();
        return inertia('Departement/Service/Edit', ["Directions" => $Directions, "Services" => $service]);
    }

    public function update(Request $request, Service $service){
        $validateData = $request->validate([
            "numero_service" =>[
                "required",
                Rule::unique((new Service)->getTable(), "numero_service")->ignore($service->id)
            ],
            "responsable" => "required",
            "direction_id" => "required|exists:directions,id",
            "titre" => "required",
            "description" => "required",
        ]);
        $service->update([...$validateData]);
        return redirect()->back();
    }

    public function delete(Service $service){
        if(count($service->fonction)>0){
            return redirect()->back()->withErrors([
                "message" => "ce service ne peut pas etre supprimé car il existe des fonctions qui dependent de ce dernier."
            ]);
            
        }
        $service->delete();
        return redirect()->back();
    }
}