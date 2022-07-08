<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\City;
use Carbon;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    public function index()
    {
        $tasks_trashed = City::onlyTrashed()->get();

        $cities = City::orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.city.index', compact('cities','tasks_trashed'));
    }

    public function create()
    {
        return view('dashboard.city.create');
    }


    public function store(Request $request)
    {
        try {
        DB::beginTransaction();
        $request->validate([
            'city_name' => 'required|unique:city,city_name'
        ]);

        //validation
        $city = City::create(['city_name' => $request->city_name]);

    
       
        DB::commit();
        return redirect()->route('admin.city')->with(['success' => 'تم ألاضافة بنجاح']);
    } catch (\Exception $ex) {
        DB::rollback();
        return redirect()->route('admin.city')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }
    }


    public function edit($id)
    {

        //get specific carmodel and its translations
        $cities = City::find($id);

        if (!$cities) {
            return redirect()->route('admin.city')->with(['error' => 'هذا الماركة غير موجود ']);
        }

        return view('dashboard.city.edit', compact('cities'));
    }


    public function update($id, Request  $request)
    {
        try {
            //validation
            $request->validate([
                'city_name' => 'required|unique:city,city_name'
            ]);
            //update DB


            $city = City::find($id);

            if (!$city) {
                return redirect()->route('admin.city')->with(['error' => 'هذا الماركة غير موجود']);
            }


            DB::beginTransaction();


            $city->update($request->except('_token', 'id'));  // update only for slug column

            
            DB::commit();
            return redirect()->route('admin.city')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.city')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $city = City::find($id);

            if (!$city) {
                return redirect()->route('admin.city')->with(['error' => 'هذا الماركة غير موجود ']);
            }
            $ts = Carbon\Carbon::now()->toDateTimeString();
            $data = array('deleted_at' => $ts, 'deleted_by' => Auth::user()->id);
            DB::table('city')->where('id', $id)->update($data);
            $city->delete();

            return redirect()->route('admin.city')->with(['success' => 'تم  الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.city')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    
    public function restore($id)
    {
        City::withTrashed()->find($id)->restore();
  
        return back();
    } 
    public function restoreAll()
    {
        City::onlyTrashed()->restore();
  
        return back();
    }
    public function damage($id)
    {
        $task = City::withTrashed()->where('id',$id);
        $task->forceDelete();

        return redirect()->back();
    }
}