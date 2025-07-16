<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentClassResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'campus' => new CampusResource($this->campus),
            "class" => new SchoolClassResource($this->schoolClass),
            "section" => new SectionResource($this->section),
            'group' => new GroupResource($this->group),
            'roll' => $this->roll,
            'roll_postfix' => $this->roll_postfix,
            'year' => $this->year,

        ];
    }
}
