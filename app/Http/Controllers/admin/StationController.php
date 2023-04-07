<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\admin\Controller;
use App\Models\Station;
use Illuminate\Http\Request;
use App\Http\Requests\admin\StationRequest;
use App\Http\Requests\admin\ImportRequest;
use Illuminate\Support\Facades\DB;
use App\Exports\Station as export_Station;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Station as import_Station;

class StationController extends Controller{
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
        return view('admin.stations.index')->withStations(Station::orderByDesc('id')->paginate(24));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  StationRequest $request
     */
    public function store(StationRequest $request){
        DB::beginTransaction();
        try{
            $station = Station::create($request->except('image'));
            DB::commit();
            return $this->update($request, $station);
        }
        catch(\Exception $e){
            DB::rollBack();
        }
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  StationRequest $request
     */
    public function update(Request $request, Station $station){
        DB::beginTransaction();
        try{
            $station->update($request->except('image'));
            $station->forceFill([
                'image' => $this->upload('image') ? : $station->image,
            ])->save();
            DB::commit();
            return $request->ajax() ? response()->json([
                'success' => true,
                'message' => __('Station saved successully.'),
                'redirect' => route('admin.stations.index'),
            ]) : redirect()->route('admin.stations.index')->withSuccess(__('Station saved successully.'));
        }
        catch(\Exception $e){
            DB::rollBack();
            return $this->error($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  Station $station
     */
    public function destroy(Station $station){
        try{
            $station->delete();
            return redirect()->back()->withSuccess(__('Station deleted successully.'));
        }
        catch(\Exception $e){
            return $this->error($e);
        }
    }

    /**
     * Import the resource to storage
     * 
     * @param  Request $request
     */
    public function import(ImportRequest $request){
        DB::beginTransaction();
        try{
            Excel::import(new import_Station, $request->file('file')->store('temp'));
            DB::commit();
            return $request->ajax() ? response()->json([
                'success' => true,
                'message' => __('Stations imported successully.'),
                'redirect' => route('admin.stations.index'),
            ]) : redirect()->route('admin.stations.index')->withSuccess(__('Stations imported successully.'));
        }
        catch(\Exception $e){
            DB::rollBack();
            return $this->error($e);
        }
    }

    /**
     * Export the resource to spreadsheet
     * 
     * @param  Request $request
     */
    public function export(Request $request){
        return Excel::download(new export_Station(Station::all()), "stations.xlsx");
    }
}
