<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;
    protected $fillable = ["id","numero_employer","nom","prenom","sexe","date_naissance", "adresse", "telephone", 
    "email", "date_embauche", "fonction_id", "grade_id", "corps_id"];

    public function fonction(){
        return $this->belongsTo(Fonction::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }

    public function corps(){
        return $this->belongsTo(Corps::class);
    }
    public function service()
    {
        return $this->belongsToThrough(Service::class, Fonction::class);
    }
    public function rilier_experience(){
        return $this->hasMany(RilierExperience::class);
    }
    public function relierformation(){
        return $this->hasMany(relierformation::class);
    }
    
    public function relier_evaluation(){
        return $this->hasMany(RelierEvaluation::class);
    }

    public function relier_promotion(){
        return $this->hasMany(RelierPromotion::class);
    }

    public function candidature(){
        return $this->hasMany(Candidature::class);
    }

}