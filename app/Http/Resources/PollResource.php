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
        $baseData = [
            'title' => $this->title,
            'created_at' => $this->created_at
        ];

        if ($request->query('page') === 'details'){
            $baseData = array_merge($baseData , [
//                TODO return question of the poll in question resource
            ]);
        }
        return [
            'title' => $this->title,
            'created_at' => $this->created_at
        ];
    }
}
