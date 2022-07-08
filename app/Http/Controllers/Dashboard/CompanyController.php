<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Company;
use Carbon;
use Illuminate\Support\Facades\Auth;
class CompanyController extends Controller
{
    public function index()
    {
        $tasks_trashed = Company::onlyTrashed()->get();

        
        $companies = Company::orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.company.index', compact('companies','tasks_trashed'));
    }

    public function create()
    {
        return view('dashboard.company.create');
    }


    public function store(Request $request)
    {
        try {
        DB::beginTransaction();
        $request->validate([
            'company_name' => 'required|unique:company,company_name',
            'company_code' => 'required|unique:company,company_code'

        ]);

        //validation
        $company = Company::create([
            'company_name' => $request->company_name,
            'company_code' => $request->company_code,

        ]);
    
       
        DB::commit();
        return redirect()->route('admin.company')->with(['success' => 'تم ألاضافة بنجاح']);
          } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.company')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function edit($id)
    {

        //get specific carmodel and its translations
        $companies = Company::find($id);

        if (!$companies) {
            return redirect()->route('admin.company')->with(['error' => 'هذا الماركة غير موجود ']);
        }

        return view('dashboard.company.edit', compact('companies'));
    }


    public function update($id, Request  $request)
    {
        try {
            //validation
            $request->validate([
                'company_name' => 'required|unique:company,company_name',
                'company_code' => 'required|unique:company,company_code'
    
            ]);
            //update DB


            $company = Company::find($id);

            if (!$company) {
                return redirect()->route('admin.company')->with(['error' => 'هذا الماركة غير موجود']);
            }


            DB::beginTransaction();


            $company->update($request->except('_token', 'id'));  // update only for slug column

            
            DB::commit();
            return redirect()->route('admin.company')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.company')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $company = Company::find($id);

            if (!$company) {
                return redirect()->route('admin.company')->with(['error' => 'هذا الماركة غير موجود ']);
            }
            $ts = Carbon\Carbon::now()->toDateTimeString();
            $data = array('deleted_at' => $ts, 'deleted_by' => Auth::user()->id);
            DB::table('company')->where('id', $id)->update($data);
            $company->delete();

            return redirect()->route('admin.company')->with(['success' => 'تم  الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.company')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    public function restore($id)
    {
        Company::withTrashed()->find($id)->restore();
  
        return back();
    } 
    public function restoreAll()
    {
        Company::onlyTrashed()->restore();
  
        return back();
    }
    public function damage($id)
    {
        $task = Company::withTrashed()->where('id',$id);
        $task->forceDelete();

        return redirect()->back();
    }
}