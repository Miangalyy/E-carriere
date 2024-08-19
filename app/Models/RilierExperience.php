<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RilierExperience extends Model
{
    use HasFactory;
    protected $fillable = ["numero", "experience_id", "nom_entreprise", "description", "employer_id", "date_debut", "date_fin"];
    
    public function experience(){
        return $this->belongsTo(Experience::class);
       }

    public function employer(){
        return $this->belongsTo(Employer::class);
    }
}