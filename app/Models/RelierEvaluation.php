<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelierEvaluation extends Model
{
    use HasFactory;
    protected $fillable = ["numero", "employer_id", "evaluation_id", "commentaire", "date"];
    
    public function evaluation(){
        return $this->belongsTo(Evaluation::class);
       }

    public function employer(){
        return $this->belongsTo(Employer::class);
    }
}