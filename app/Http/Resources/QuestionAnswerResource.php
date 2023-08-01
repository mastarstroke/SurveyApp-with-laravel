<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use URL;
use DateTime;
use App\Http\Resources\SurveyQuestionResource;


class QuestionAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {   
        return [
            'id' => $this->id,

            'image_url' =>$this->image ? URL::to($this->image) : null,
            'title' => $this->title,
            'slug' => $this->slug,
            'status' => $this->status,
            'description' => $this->description,
            'expire_date' => $this->expire_date,
            'questions' => SurveyQuestionResource::collection($this->questions),
            
        ];
    }
}
