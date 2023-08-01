<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Survey;
use App\Models\SurveyQuestionAnswers;

class SurveyAnswers extends Model
{
    use HasFactory;

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = ['survey_id', 'start_date', 'end_date'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    
    public function surveyQuestionAnswers()
    {
        return $this->hasMany(SurveyQuestionAnswers::class);
    }
}
