<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Codriver;
use Carbon;

use Illuminate\Support\Facades\Auth;
class CodriverController extends Controller
{
    public function index()
    {
        $tasks_trashed = Codriver::onlyTrashed()->get();

        
        $codrivers = Codriver::orderBy('id','DESC')->paginate(10);
        return view('dashboard.codriver.index',compact('codrivers','tasks_trashed'));
    }

    public function create()
    {
        return view('dashboard.codriver.create');
    }

    public function store(Request $request)
    {

        try {

            DB::beginTransaction();

            
            // Driver::create($request->all());
            $codriver = Codriver::create([
                'co_driver_name' => $request->co_driver_name,
                'Date_of_birth' => Carbon::parse($request->Date_of_birth),
               
            ]);
          
            DB::commit();
            return redirect()->route('admin.codriver')->with(['success' => 'تم ألاضافة بنجاح']);
          

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.codriver')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function edit($id)
    {

        //get specific categories and its translations
        $codriver = Codriver::find($id);

        if (!$codriver) {
            return redirect()->route('admin.codriver')->with(['error' => 'هذا السائق غير موجود ']);
        }

        return view('dashboard.codriver.edit', compact('codriver'));
    }


    public function update($id,Request  $request)
    {
        try {
            

            $codriver = Codriver::find($id);

            if (!$codriver) {
                return redirect()->route('admin.codriver')->with(['error' => 'هذا السائق غير موجود']);
            }


            DB::beginTransaction();


         
            $codriver->update([
             
                'co_driver_name'=>$request->co_driver_name,
                'Date_of_birth' => Carbon::parse($request->Date_of_birth),
            ]);

            DB::commit();
            return redirect()->route('admin.codriver')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.codriver')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {
        try {
         
            $codriver = Codriver::find($id);

            if (!$codriver) {
                return redirect()->route('admin.codriver')->with(['error' => 'هذا الماركة غير موجود ']);
            }
            $ts = Carbon\Carbon::now()->toDateTimeString();
            $data = array('deleted_at' => $ts, 'deleted_by' => Auth::user()->id);
            DB::table('co_driver')->where('id', $id)->update($data);
            $codriver->delete();

            return redirect()->route('admin.codriver')->with(['success' => 'تم  الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.codriver')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
     public function restore($id)
    {
        Codriver::withTrashed()->find($id)->restore();
  
        return back();
    } 
    public function restoreAll()
    {
        Codriver::onlyTrashed()->restore();
  
        return back();
    }
    public function damage($id)
    {
        $task = Codriver::withTrashed()->where('id',$id);
        $task->forceDelete();

        return redirect()->back();
    }
}