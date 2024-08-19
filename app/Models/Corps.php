<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corps extends Model
{
    use HasFactory;
    protected $fillable = ["numero_corps", "titre", "description"];

    public function employer(){
      return $this->hasMany(Employer::class);
  }
}