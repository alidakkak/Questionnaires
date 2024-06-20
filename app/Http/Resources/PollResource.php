<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PollResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->route()->uri() === 'api/questionWithAnswer') {
            return [
                'id' => $this->id,
                'question' => $this->question,
                'answers' => AnswerResource::collection($this->answer),
            ];
        }

        return [
            'id' => $this->id,
            'question' => $this->question,
        ];
    }
}
