<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\SurveyAnswers;
use App\Models\SurveyQuestionAnswers;

use App\Http\Resources\FeedbackResource;
use App\Http\Resources\SurveyAnswerResource;
use App\Http\Resources\QuestionAnswerResource;
use App\Http\Resources\FeedbackAnswerResource;

use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{

    public function showFeedback(Request $request)
    {
        // FeedBacks
        
        $user = $request->user();
        return FeedbackResource::collection(Survey::where('user_id', $user->id)
        ->paginate(10));
    }


    public function showFeedbackAnswer(Request $request, $id)
    {
        // FeedBackAnswers
        return SurveyAnswerResource::collection(SurveyAnswers::where('survey_id', $id)
        ->latest('start_date')->paginate(6));
    }


    public function showFeedbackQuestionAns($id)
    {
        $answers = SurveyQuestionAnswers::query()
        ->join('survey_questions', 'survey_question_answers.survey_question_id', '=', 'survey_questions.id')
        ->where('survey_question_answers.survey_answer_id', $id)
        ->get();

        return [
            'questionAnswers' => FeedbackAnswerResource::collection($answers)
        ];
    }


}
