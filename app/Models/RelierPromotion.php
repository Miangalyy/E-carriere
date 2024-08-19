<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelierPromotion extends Model
{
    use HasFactory;
    protected $fillable = ["numero", "employer_id", "promotion_id", "motif", "date"];
    
    public function promotion(){
        return $this->belongsTo(Promotion::class);
       }

    public function employer(){
        return $this->belongsTo(Employer::class);
    }
}