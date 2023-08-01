<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Survey;
use App\Models\SurveyAnswers;

class SurveyQuestionAnswers extends Model
{
    use HasFactory;

    protected $fillable = ['survey_id', 'survey_question_id', 'survey_answer_id', 'answer'];


    public function surveyAnswers()
    {
        return $this->belongsTo(SurveyAnswers::class);
    }


}
