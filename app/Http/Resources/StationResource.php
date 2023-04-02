<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StationResource extends JsonResource{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array{
        return [
            'name' => $this->name,
            'id' => $this->id,
            'image_url' => $this->image_url,
            'description' => $this->description,
            'price' => $this->price,
            'charging_speed' => $this->charging_speed,
            'charger_type' => $this->charger_type,
            'marker_url' => asset('uploads/marker.png'),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
        ];
    }
}
