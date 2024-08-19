<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    protected $fillable = ["numero_direction", "titre", "description", "responsable"];
    
    public function service(){
        return $this->hasMany(Service::class);
    }

    public function fonction(){
        return $this->hasManyThrough(Fonction::class, Service::class);
    }
    public function employer(){
        return $this->hasManyDeep(Employer::class, [Service::class, Fonction::class]);
    }
}