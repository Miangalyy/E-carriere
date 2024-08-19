<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Direction;
use App\Models\Opportunite;
use App\Models\RelierEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    public function index(){
      /*  $employer  = DB::table('opportunites')
        ->leftJoin('candidatures', 'candidatures.opportunite_id', '=', 'opportunites.id')
        ->select('opportunites.titre as titre', 'opportunites.date as date',DB::raw('COUNT(*) as nombre'),)
        ->groupBy('date', 'titre')
        ->get();
        $employer = Opportunite::selectRaw('id, DATE(date) as date_opp, titre')
        ->withCount('candidature')
        ->get()
        ->groupBy('date_opp');
        return inertia('Youtube');
                */
           // $employer = DB::table('candidatures')
         //   ->select('date', DB::raw('COUNT(DISTINCT employer_id) as nombre'),)
         //   ->groupBy('date')
        //    ->get();
        $employer = DB::table('employers')
        ->select('fonction_id')
        ->where('numero_employer', '=', '2452')
        ->get();
            return response()->json(["employers" => $employer]);
        
            
    }
}
/*        $totalRevenue = DB::table('partner_revenues')
            ->select('lp_users.email', DB::raw('SUM(revenue) as total'))
            ->join('lp_users', 'partner_revenues.user_id', '=', 'lp_users.id')
            ->join('partners', 'partner_revenues.partner_id', '=', 'partners.id')
            ->join('pocs', 'partner_revenues.poc_id', '=', 'pocs.id')
            ->groupBy('partner_revenues.user_id')
            ->paginate(15);
            Autre solution
            $user = User::with(['messages' => function($query) {
            $query->select('messages.user_id');
            $query->groupBy('user_id');
        }])->get();

            
            */