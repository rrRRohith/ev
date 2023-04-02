<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Station extends Model{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'address',
        'price',
        'charger_type',
        'charging_speed',
        'description',
        'latitude',
        'longitude'
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

    public function scopeNearBy($query, \Illuminate\Http\Request $r){ //$query // Illuminate\Http\Request $request
        return $query->where(function($q) use($r){
            $radius = $r->radius ?? 50;
            if($r->has('latitude') && $r->has('longitude')){
                return $q->whereRaw("6371 * acos(cos(radians(".$r->latitude.")) 
                * cos(radians(latitude)) 
                * cos(radians(longitude) - radians(".$r->longitude.")) 
                + sin(radians(".$r->latitude.")) 
                * sin(radians(latitude))) <= $radius");
                /*return $q->whereRaw(DB::raw("6371 * acos(cos(radians(".$r->latitude.")) 
                * cos(radians(latitude)) 
                * cos(radians(longitude) - radians(".$r->longitude.")) 
                + sin(radians(".$r->latitude.")) 
                * sin(radians(latitude))) <= $radius"));*/
            }
            return $q;
        });
    }

    public function scopeMultiNearBy($query, \Illuminate\Http\Request $r){ //$query // Illuminate\Http\Request $request
        return $query->where(function($q) use($r){
            $radius = $r->radius ?? 50;
            foreach($r->wayouts ?? [] as $p){
                if(isset($p['lat']) && isset($p['lng'])){
                    $q->orWhereRaw("6371 * acos(cos(radians(".$p['lat'].")) 
                    * cos(radians(latitude)) 
                    * cos(radians(longitude) - radians(".$p['lng'].")) 
                    + sin(radians(".$p['lat'].")) 
                    * sin(radians(latitude))) <= $radius");
                }
            }
            return $q;
        });
    }
}
