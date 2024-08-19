<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $fillable = [ "titre"];

    public function relier_evaluation(){
        return $this->hasMany(RelierEvaluation::class);
    }
}