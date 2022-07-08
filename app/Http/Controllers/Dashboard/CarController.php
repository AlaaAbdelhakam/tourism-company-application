<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\CarModel;
use App\Models\Car;
use Carbon;
use Illuminate\Support\Facades\Auth;
class CarController extends Controller
{
    public function index()
    {
        $tasks_trashed = Car::onlyTrashed()->get();

        // $models = CarModel::all();
        $cars = Car::orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.cars.index', compact('cars','tasks_trashed'));
    }

    public function create()
    {
        $models = CarModel::all();

        return view('dashboard.cars.create',compact('models'));
    }


    public function store(Request $request)
    {
        try {
        DB::beginTransaction();
        $request->validate([
            'car_code' => 'required|unique:cars,car_code'
        ]);

        //validation
        // $model = Car::create(['car_model_name' => $request->car_model_name]);
        $car = Car::create([
            'capacity' => $request->capacity,
            'plate_no' => $request->plate_no,
            'car_model_id' => $request->car_model_id,
            'car_code' => $request->car_code,
            'expected_amount_of_solar_for_100Km' => $request->expected_amount_of_solar_for_100Km,

        ]);
        
    
       
        DB::commit();
        return redirect()->route('admin.cars')->with(['success' => 'تم ألاضافة بنجاح']);
    } catch (\Exception $ex) {
        DB::rollback();
        return redirect()->route('admin.cars')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }
    }


    public function edit($id)
    {

        //get specific carmodel and its translations
        $car = Car::find($id);
        $models = CarModel::all();

        if (!$models) {
            return redirect()->route('admin.cars')->with(['error' => 'هذا الماركة غير موجود ']);
        }

        return view('dashboard.cars.edit', compact('models','car'));
    }


    public function update($id, Request  $request)
    {
        try {
            //validation
            $request->validate([
                'car_code' => 'required|unique:cars,car_code'
            ]);
            //update DB


            $car = Car::find($id);

            if (!$car) {
                return redirect()->route('admin.cars')->with(['error' => 'هذا الماركة غير موجود']);
            }


            DB::beginTransaction();


            $car->update([
             
                'capacity' => $request->capacity,
                'plate_no' => $request->plate_no,
                'car_model_id' => $request->car_model_id,
                'car_code' => $request->car_code,
                'expected_amount_of_solar_for_100Km' => $request->expected_amount_of_solar_for_100Km,
            ]);

            
            DB::commit();
            return redirect()->route('admin.cars')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.cars')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $car = Car::find($id);

            if (!$car) {
                return redirect()->route('admin.cars')->with(['error' => 'هذا الماركة غير موجود ']);
            }
            $ts = Carbon\Carbon::now()->toDateTimeString();
            $data = array('deleted_at' => $ts, 'deleted_by' => Auth::user()->id);
            DB::table('cars')->where('id', $id)->update($data);
            $car->delete();

            return redirect()->route('admin.cars')->with(['success' => 'تم  الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.cars')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
     public function restore($id)
    {
        Car::withTrashed()->find($id)->restore();
  
        return back();
    } 
    public function restoreAll()
    {
        Car::onlyTrashed()->restore();
  
        return back();
    }
    public function damage($id)
    {
        $task = Car::withTrashed()->where('id',$id);
        $task->forceDelete();

        return redirect()->back();
    }
}