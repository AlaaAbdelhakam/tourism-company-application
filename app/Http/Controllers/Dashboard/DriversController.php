<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Driver;
use App\Http\Requests\DriverRequest;
use Carbon;
use Illuminate\Support\Facades\Auth;

class DriversController extends Controller
{
    public function index()
    {
        $tasks_trashed = Driver::onlyTrashed()->get();

        $drivers = Driver::orderBy('id','DESC')->paginate(10);
        return view('dashboard.drivers.index',compact('drivers','tasks_trashed'));
    }

    public function create()
    {
        //  $categories = Category::parent()->orderBy('id','DESC') -> get();
        return view('dashboard.drivers.create');
    }

    public function store(DriverRequest $request)
    {

        try {

            DB::beginTransaction();

            
            // Driver::create($request->all());
            $driver = Driver::create([
                'driver_name' => $request->driver_name,
                'Date_of_birth' => Carbon::parse($request->Date_of_birth),
                'address' => $request->address,
            ]);
          
            DB::commit();
            return redirect()->route('admin.drivers')->with(['success' => 'تم ألاضافة بنجاح']);
          

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.drivers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function edit($id)
    {

        //get specific categories and its translations
        $driver = Driver::find($id);

        if (!$driver) {
            return redirect()->route('admin.drivers')->with(['error' => 'هذا السائق غير موجود ']);
        }

        return view('dashboard.drivers.edit', compact('driver'));
    }


    public function update($id, Request  $request)
    {
        try {
            

            $driver = Driver::find($id);

            if (!$driver) {
                return redirect()->route('admin.drivers')->with(['error' => 'هذا السائق غير موجود']);
            }


            DB::beginTransaction();


            $driver->update([
             
                'driver_name' => $request->driver_name,
                'Date_of_birth' => Carbon::parse($request->Date_of_birth),
                'address' => $request->address,
            ]);
           

            DB::commit();
            return redirect()->route('admin.drivers')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.drivers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {
        try {
         
            $driver = Driver::find($id);

            if (!$driver) {
                return redirect()->route('admin.drivers')->with(['error' => 'هذا الماركة غير موجود ']);
            }
            $ts = Carbon\Carbon::now()->toDateTimeString();
            $data = array('deleted_at' => $ts, 'deleted_by' => Auth::user()->id);
            DB::table('drivers')->where('id', $id)->update($data);
            $driver->delete();

            return redirect()->route('admin.drivers')->with(['success' => 'تم  الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.drivers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
        public function restore($id)
    {
        Driver::withTrashed()->find($id)->restore();
  
        return back();
    } 
    public function restoreAll()
    {
        Driver::onlyTrashed()->restore();
  
        return back();
    }
    public function damage($id)
    {
        $task = Driver::withTrashed()->where('id',$id);
        $task->forceDelete();

        return redirect()->back();
    }
    
}