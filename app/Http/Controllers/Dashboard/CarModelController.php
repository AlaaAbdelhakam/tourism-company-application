<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\CarModel;
use Carbon;
use Illuminate\Support\Facades\Auth;
class CarModelController extends Controller
{
   
    public function index()
    {
        $tasks_trashed = CarModel::onlyTrashed()->get();

        $models = CarModel::orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.carmodels.index', compact('models','tasks_trashed'));
    }

    public function create()
    {
        return view('dashboard.carmodels.create');
    }


    public function store(Request $request)
    {
        try {
        DB::beginTransaction();
        $request->validate([
            'car_model_name' => 'required|unique:car_model,car_model_name'
        ]);

        //validation
        $model = CarModel::create(['car_model_name' => $request->car_model_name]);

    
       
        DB::commit();
        return redirect()->route('admin.carmodel')->with(['success' => 'تم ألاضافة بنجاح']);
    } catch (\Exception $ex) {
        DB::rollback();
        return redirect()->route('admin.carmodel')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }
    }


    public function edit($id)
    {

        //get specific carmodel and its translations
        $models = CarModel::find($id);

        if (!$models) {
            return redirect()->route('admin.carmodel')->with(['error' => 'هذا الماركة غير موجود ']);
        }

        return view('dashboard.carmodels.edit', compact('models'));
    }


    public function update($id, Request  $request)
    {
        try {
            //validation
            $request->validate([
                'car_model_name' => 'required|unique:car_model,car_model_name'
            ]);
            //update DB


            $model = CarModel::find($id);

            if (!$model) {
                return redirect()->route('admin.carmodel')->with(['error' => 'هذا الماركة غير موجود']);
            }


            DB::beginTransaction();


            $model->update($request->except('_token', 'id'));  // update only for slug column

            
            DB::commit();
            return redirect()->route('admin.carmodel')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.carmodel')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $models = CarModel::find($id);

            if (!$models) {
                return redirect()->route('admin.carmodel')->with(['error' => 'هذا الماركة غير موجود ']);
            }
            $ts = Carbon\Carbon::now()->toDateTimeString();
            $data = array('deleted_at' => $ts, 'deleted_by' => Auth::user()->id);
            DB::table('car_model')->where('id', $id)->update($data);
            $models->delete();

            return redirect()->route('admin.carmodel')->with(['success' => 'تم  الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.carmodel')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
     public function restore($id)
    {
        CarModel::withTrashed()->find($id)->restore();
  
        return back();
    } 
    public function restoreAll()
    {
        CarModel::onlyTrashed()->restore();
  
        return back();
    }
    public function damage($id)
    {
        $task = CarModel::withTrashed()->where('id',$id);
        $task->forceDelete();

        return redirect()->back();
    }
}