<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use DB;
use App\Models\Users;
use App\Models\User;
use Hash;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UpdateUserRequest;
use App\Models\City;

use Spatie\Permission\Models\Permission;
class UsersController extends Controller
{
    public function index()
    {
        $tasks_trashed = User::onlyTrashed()->get();

        $data = User::orderBy('id','DESC')->paginate(1);
        // $users = Users::latest()->paginate(2);
        return view('dashboard.users.index',compact('data','tasks_trashed'));
    }

    public function create(User $user)
    { 
   
        $cities=City::all();
        $roles = Role::pluck('name','name')->all();
        return view('dashboard.users.create',compact('roles','cities'));
    }


    public function store(Request $request)
    {

        try {

            // DB::beginTransaction();
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'roles' => 'required'
            ]);
        
       

        $input = $request->all();
      
    
        $user = User::create($input);
       
        $user->assignRole($request->input('roles'));
    


        
            // DB::commit();
            return redirect()->route('admin.users')->with(['success' => 'تم ألاضافة بنجاح']);
          

        } catch (\Exception $ex) {
            // DB::rollback();
            return redirect()->route('admin.users')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function edit($id) 
    {
        
        $user = User::find($id);
        $cities=City::all();
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
         return view('dashboard.users.edit',compact('user','roles','userRole','cities'));
    }
   

    public function update($id, Request $request)
    {
        // try {
            //validation

            //update DB
           
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
                'password' => 'same:confirm-password',
                'roles' => 'required'
            ]);
        

            $input = $request->all();
       
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
            return redirect()->route('admin.users')
                ->withSuccess(__('تم ألتحديث بنجاح'));

       
    }


    public function destroy($id)
    {

        try {
            //get specific categories and its translations
            $users = User::orderBy('id', 'DESC')->find($id);

            if (!$users)
                return redirect()->route('admin.users')->with(['error' => 'هذا المستخدم غير موجود ']);

            $users->delete();

            return redirect()->route('admin.users')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.users')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();
  
        return back();
    } 
    public function restoreAll()
    {
        User::onlyTrashed()->restore();
  
        return back();
    }
    public function damage($id)
    {
        $task = User::withTrashed()->where('id',$id);
        $task->forceDelete();

        return redirect()->back();
    }
}