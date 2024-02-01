<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleShowResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'alias' => $this->alias,
            'created_at' => (new Carbon ($this->created_at))->format(config('panel.datetime_format')),
            'updated_at' => (new Carbon ($this->updated_at))->format(config('panel.datetime_format')),
        ];
    }
}
