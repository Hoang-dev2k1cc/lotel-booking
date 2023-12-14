<?php

namespace App\Http\Controllers\Admin\users;
use App\Models\User;
use App\Models\booking;
use Error;
use App\Http\Controllers\Controller;
use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
class UserController extends Controller
{
    public function showRegisterAdmin()
    {

        return view('web.register');
    }

    public function postRegisterAdmin(Request $request)
    {

        if($request->has('file_upload')){
            $file = $request->file_upload;
            $ext = $request->file_upload->extension();
            $file_name = time().'-'.'User.'.$ext;
            $file->move(public_path('uploads'), $file_name);
        }
        $request->merge(['photo'=> $file_name]);


        // dd($request->all());
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>bcrypt($request->password),
            'role'=>$request->role,
            'photo'=>$request->photo,
        ]);
        return redirect()->back()->with('error','Tạo tài khoản thành công');

    }

    public function showLoginAdmin()
    {
        return view(view:'web.login');
    }

    public function postLoginAdmin(Request $request)
    {
        // dd($request->all());
       $remember = $request->remember;
       if(Auth::attempt(['email' => $request->email,
        'password' => $request->password,'role'=>0
        ],$remember)){
        return redirect()->route('admin.statis');
       }
       return redirect()->back()->with('error','sai cmnr');

    }


    public function usersIndex()
    {
      $data = User::where('role', '>', 0)->paginate(5);
      return view('admin.users.index',compact('data'));
    }

    public function usersDestroy( string $id)
    {
        // $User = DB::table('users');

        $User=User::find($id);
            if($User->booking->count() > 0){
                return redirect()->route('users.index')->with('error','Không thể xóa tài khoản này');
            }else{
                User::destroy($id);
                return redirect()->route('users.index')->with('success','Xóa Tài khoản thành công');
            }




    }

    public function usersEdit(string $id)
  {


    $us = User::find($id);


    return view('admin.users.edit',compact('us'));


  }

  public function usersUpdate(Request $request,string $id)
  {
    $request->validate(
        [
            'email' => 'required|email',
            'name' => 'required',

        ]

    );

    $user = User::find($id);
    $user->name= $request->input('name');
    $user->email= $request->input('email');
    $user->phone= $request->input('phone');

    if ($request->has('file_upload')) {
        $destination = 'uploads/users/' . $user->photo;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $file = $request->file('file_upload');
        $extention = $file->getClientOriginalExtension();
        $filename = time() . '-' . 'user.' . $extention;
        $file->move('uploads/users/', $filename);
        $user->photo = $filename;
    }


    $user->save();

    return redirect()->back()->with('success','Sửa danh mục thành công');
  }


  public function logoutAdmin(){
    Auth::logout();
    return redirect()->route('showLoginAdmin');
}
}
