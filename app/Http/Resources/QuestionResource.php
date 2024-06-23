<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $baseData = [
            'title' => $this->title,
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y'),
            'answers' => AnswerResource::collection($this->answers),
            'pivot' => $this->pivot
        ];
        return $baseData;
    }
}
