<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource{
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
            'model' => $this->model,
            'make' => $this->make,
            'trim' => $this->trim,
            'drive_range' => $this->drive_range,
            'charger_type' => $this->charger_type,
            'charging_time' => $this->charging_time,
        ];
    }
}
