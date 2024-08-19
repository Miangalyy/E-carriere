<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;
    protected $fillable = ["numero", "employer_id", "opportunite_id", "date", "statut"];
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
    public function opportunite()
    {
        return $this->belongsTo(Opportunite::class);
    }
}