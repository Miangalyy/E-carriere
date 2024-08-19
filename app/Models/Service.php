<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ["numero_service", "titre", "description", "direction_id", "responsable"];

    public function direction(){
     return $this->belongsTo(Direction::class);
    }
    public function fonction(){
        return $this->hasMany(Fonction::class);
    }
    public function employer(){
        return $this->hasManyThrough(Employer::class, Fonction::class);
    }
}