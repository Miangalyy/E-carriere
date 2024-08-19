<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    use HasFactory;
    protected $fillable = ["titre", "numero_fonction", "description", "service_id"];
    
    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function employer(){
        return $this->hasMany(Employer::class);
    }
    public function direction()
    {
        return $this->belongsToThrough(Direction::class, Service::class);
    }


}