<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Station, Car};
use App\Http\Resources\{StationResource, CarResource};

class MapController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request){
        $stations = Station::query()->nearBy($request)->get();
        return $request->ajax() ? response()->json(StationResource::collection($stations)) : view('web.map.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Response
     */
    public function stations(Request $request){
        $stations = Station::query()->multiNearBy($request)->get();
        return response()->json(StationResource::collection($stations));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Response
     */
    public function models(Request $request){
        $models = Car::query()->search($request)->limit(6)->get();
        return response()->json(CarResource::collection($models));
    }
}
