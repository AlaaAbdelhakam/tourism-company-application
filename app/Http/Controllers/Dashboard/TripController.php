<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\City;
use App\Models\Driver;
use App\Models\Codriver;
use App\Models\User;
use App\Models\Company;
use App\Models\Car;
use App\Models\Trip;
use Auth;
use Carbon;
use PDF;

class TripController extends Controller
{
    public function index()
    {
        $tasks_trashed = Trip::onlyTrashed()->get();

        //remove elseif at any moment
        if(Auth::user()->hasRole('superadmin'))
            $trips=Trip::all();
            elseif(Auth::user()->hasRole('admin'))
            $trips=Trip::all();
            else

            $trips = Trip::where('user_id', '=', Auth::user()->id)->get();
            // $models = CarModel::all();
        return view('dashboard.trip.index', compact('trips','tasks_trashed'));
    }

    public function create()
    {

        $drivers = Driver::all();
        $codrivers = Codriver::all();
        $companies = Company::all();
        $cars = Car::all();
        $users=User::where('id', '=', Auth::user()->id)->get();


        if(Auth::user()->hasRole('superadmin'))
        $cities = City::all();
        elseif(Auth::user()->hasRole('admin'))
        $cities = City::all();
        else
        $cities = City::where('id', '=', Auth::user()->city_id)->get();

        
     
    
        return view('dashboard.trip.create',compact('cities','drivers','codrivers','companies','cars','users'));
    }


    public function store(Request $request)
    {
        try {
    
        DB::beginTransaction();
        
        $trip = Trip::create([
            'city_id' => $request->city_id,
            'car_id' => $request->car_id,
            'driver_id' => $request->driver_id,
            'co_driver_id' => $request->co_driver_id,
            'company_id' => $request->company_id,
            'user_id' => $request->user_id,
            'route_name' => $request->route_name,
            'work_code' => $request->work_code,
            'Km_start' => $request->Km_start,
            'km_end' => $request->km_end,
            'total_distance' => $request->km_end-$request->Km_start,
            'Date_of_trip' => Carbon::parse($request->Date_of_trip),
            'time_out' => Carbon::parse($request->time_out),
            'time_in' => Carbon::parse($request->time_in),
            // 'total_time' =>  Carbon::parse($request->time_out-$request->time_in),
            'total_time' =>Carbon::parse((strtotime($request->time_out) - strtotime($request->time_in))),

        ]);
        
    
       
        DB::commit();
        return redirect()->route('admin.trip')->with(['success' => 'تم ألاضافة بنجاح']);
    } catch (\Exception $ex) {
        DB::rollback();
        return redirect()->route('admin.trip')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }
    }


    public function edit($id)
    {

        //get specific carmodel and its translations
        $trip = Trip::find($id);
        $cities = City::all();
        $drivers = Driver::all();
        $codrivers = Codriver::all();
        $companies = Company::all();
        $cars = Car::all();
        $users=User::where('id', '=', Auth::user()->id)->get();

        if (!$trip) {
            return redirect()->route('admin.trip')->with(['error' => 'هذا الماركة غير موجود ']);
        }

        return view('dashboard.trip.edit', compact('cities','drivers','codrivers','companies','cars','trip','users'));
    }


    public function update($id, Request  $request)
    {
        try {
            //validation
           

            $trip = Trip::find($id);

            if (!$trip) {
                return redirect()->route('admin.trip')->with(['error' => 'هذا الماركة غير موجود']);
            }


            DB::beginTransaction();


            $trip->update([
             
                'city_id' => $request->city_id,
                'car_id' => $request->car_id,
                'driver_id' => $request->driver_id,
                'co_driver_id' => $request->co_driver_id,
                'company_id' => $request->company_id,
                'user_id' => $request->user_id,
                'route_name' => $request->route_name,
                'work_code' => $request->work_code,
                'Km_start' => $request->Km_start,
                'km_end' => $request->km_end,
                'total_distance' => $request->km_end-$request->Km_start,
                'Date_of_trip' => Carbon::parse($request->Date_of_trip),
                'time_out' => Carbon::parse($request->time_out),
                'time_in' => Carbon::parse($request->time_in),
                // 'total_time' =>  Carbon::parse($request->time_out-$request->time_in),
                'total_time' =>Carbon::parse((strtotime($request->time_out) - strtotime($request->time_in))),
            ]);

            
            DB::commit();
            return redirect()->route('admin.trip')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.trip')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $trip = Trip::find($id);

            if (!$trip) {
                return redirect()->route('admin.trip')->with(['error' => 'هذا الماركة غير موجود ']);
            }
            $ts = Carbon\Carbon::now()->toDateTimeString();
            $data = array('deleted_at' => $ts, 'deleted_by' => Auth::user()->id);
            DB::table('trip')->where('id', $id)->update($data);
            $trip->delete();

            return redirect()->route('admin.trip')->with(['success' => 'تم  الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.trip')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
     public function restore($id)
    {
        Trip::withTrashed()->find($id)->restore();
  
        return back();
    } 
    public function restoreAll()
    {
        Trip::onlyTrashed()->restore();
  
        return back();
    }
    public function damage($id)
    {
        $task = Trip::withTrashed()->where('id',$id);
        $task->forceDelete();

        return redirect()->back();
    }
    public function searchindex()
    {   
       return view('dashboard.trip.searchdate');
    }

    public function daily_report(Request $request)
    {
       $start_date = Carbon::parse($request->start_date)
                             ->toDateTimeString();

       $end_date = Carbon::parse($request->end_date)
                             ->toDateTimeString();
                             $search = $request->input('search');

                             $trips = Trip::with('cities');

        
        $trips = Trip::whereHas('cities', function($q) use ($search) {
            $q->where('city_name', 'LIKE', "%{$search}%");})
        ->whereBetween('Date_of_trip',[$start_date,$end_date])->get();
      
        
        return view('dashboard.trip.searchdate', compact('trips'));

    }

}