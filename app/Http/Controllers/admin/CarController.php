<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\admin\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Requests\admin\CarRequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Car as export_Car;

class CarController extends Controller{
    use \App\Services\Upload;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * @param  Request $request
     * Display a listing of the resource.
     */
    public function index(Request $request){
        return view('admin.cars.index')->withCars(Car::orderByDesc('id')->paginate(24));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  CarRequest $request
     */
    public function store(CarRequest $request){
        DB::beginTransaction();
        try{
            $car = Car::create($request->except('image'));
            DB::commit();
            return $this->update($request, $car);
        }
        catch(\Exception $e){
            DB::rollBack();
        }
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  CarRequest $request
     * @param  Car $car
     */
    public function update(CarRequest $request, Car $car){
        DB::beginTransaction();
        try{
            $car->update($request->except('image'));
            $car->update([
                'image' => $this->upload('image') ? : $car->image,
            ]);
            DB::commit();
            return $request->ajax() ? response()->json([
                'success' => true,
                'message' => __('Model saved successully.'),
                'redirect' => route('admin.cars.index'),
            ]) : redirect()->route('admin.cars.index')->withSuccess(__('Model saved successully.'));
        }
        catch(\Exception $e){
            DB::rollBack();
            return $this->error($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  Car $car
     */
    public function destroy(Car $car){
        try{
            $car->delete();
            return redirect()->back()->withSuccess(__('Model deleted successully.'));
        }
        catch(\Exception $e){
            return $this->error($e);
        }
    }

    /**
     * Export the resource to spreadsheet
     * 
     * @param  Request $request
     */
    public function export(Request $request){
        return Excel::download(new export_Car(Car::all()), "models.xlsx");
    }
}
