<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'trim',
        'make',
        'drive_range',
        'charger_type',
        'description',
        'charging_time'
    ];

    /**
     * Image of the model
     */
    public function getImageUrlAttribute(){
        return asset('uploads/'.($this->image ? : 'default.png'));
    }

    /**
     * The attributes that should be appended.
     *
     * @var array<string, string>
     */
    protected $appends = [
        'image_url'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
