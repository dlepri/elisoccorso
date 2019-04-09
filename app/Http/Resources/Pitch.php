<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Pitch extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'locality' => $this->locality,
            'municipality' => $this->municipality,
            'province' => $this->province,
            'latitude' => (float) $this->latitude,
            'longitude' => (float) $this->longitude
        ];
    }
}
