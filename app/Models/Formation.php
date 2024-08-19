<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;
    protected $fillable = ["nom_formation", "organisme_formation", "description"];
    public function relierformation(){
        return $this->hasMany(relierformation::class);
    }
}