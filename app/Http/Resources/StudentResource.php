<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'course' => $this->course,
            'birthday' => $this->birthday,
            'age' => $this->age,
            'allowance' => $this->allowance,
            'created_at' => $this->created_at,
        ];
    }
}
