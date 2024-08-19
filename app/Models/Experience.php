<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = ["fonction"];

    public function rilier_experience(){
        return $this->hasMany(RilierExperience::class);
    }
}