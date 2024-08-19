<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunite extends Model
{
    use HasFactory;
    protected $fillable = ["competence", "titre", "description", "date"];

    public function candidature(){
        return $this->hasMany(Candidature::class);
    }
}