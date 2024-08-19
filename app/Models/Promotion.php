<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = ["titre", "nv_fonction_id", "an_fonction_id"];
    

    public function relier_promotion(){
        return $this->hasMany(RelierPromotion::class);
    }
}