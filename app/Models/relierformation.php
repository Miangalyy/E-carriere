<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class relierformation extends Model
{
    use HasFactory;
    protected $fillable = ["numero", "formation_id", "employer_id", "date_debut", "date_fin"];
    
    public function formation(){
        return $this->belongsTo(Formation::class);
       }

    public function employer(){
        return $this->belongsTo(Employer::class);
    }
}