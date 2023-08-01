<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\SurveyAnswerResource;
use App\Http\Resources\SurveyResourceDashboard;

use App\Models\Survey;
use App\Models\SurveyAnswers;

class DashboardController extends Controller
{


    public function index(Request $request)
    {
        $user = $request->user();

        // Total Number of Surveys
        $total = Survey::query()->where('user_id', $user->id)->count();

        // Latest Surveys
        $latest = Survey::query()->where('user_id', $user->id)->latest('created_at')->first();

        // Total Number of Answers
        $totalAnswers = SurveyAnswers::query()
                ->join('surveys', 'survey_answers.survey_id', '=', 'surveys.id')
                ->where('surveys.user_id', $user->id)
                ->count();

        // Latest 5 answers
        $latestAnswers = SurveyAnswers::query()
                ->join('surveys', 'survey_answers.survey_id', '=', 'surveys.id')
                ->where('surveys.user_id', $user->id)
                ->orderBy('end_date', 'DESC')
                ->limit(5)
                ->getModels('survey_answers.*');

        return [
            'user' => $user->name,
            'totalSurveys' => $total,
            'latestSurveys' => $latest ? new SurveyResourceDashboard($latest) : null,
            'totalAnswers' => $totalAnswers,
            'latestAnswers' => SurveyAnswerResource::collection($latestAnswers)
        ];
    }

}
