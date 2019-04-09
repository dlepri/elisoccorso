<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Secondary extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'image' => ($this->image) ? asset('storage/'.$this->image) : null,
            'latitude' => (float) $this->latitude,
            'longitude' => (float) $this->longitude,
            'type' => new Type($this->type),
            'pitch' => new Pitch($this->pitch)
        ];
    }
}
