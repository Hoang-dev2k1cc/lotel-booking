<?php

namespace App\Http\Controllers;

use App\Models\User;
use Error;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AuthController extends Controller
{
    public function showFormRegister()
    {
        return view(view: 'auth.register');
    }

    public function postRegister(Request $request)
    {




        request()->validate(
            [

                'email' => 'required|email|unique:users',
                'password' => 'required',
                'confirm_password' => 'required|same:password',

                'file_upload' => 'required|image|mimes:jpg,jpeg,png,gif|max:10000'
            ],
        );
        if ($request->has('file_upload')) {
            $file = $request->file_upload;
            $ext = $request->file_upload->extension();
            $file_name = time() . '-' . 'User.' . $ext;
            $file->move(public_path('uploads/users'), $file_name);
        }
        $request->merge(['photo' => $file_name]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'photo' => $request->photo,
        ]);
        return redirect()->back()->with('success', 'Tạo tài khoản thành công');
    }

    public function showFormLogin()
    {
        return view(view: 'auth.login');
    }

    public function postLogin(Request $request)
    {
        request()->validate(
            [

                'email' => 'required|email|exists:users',
                'password' => 'required',
            ],
        );
        // dd($request->all());
        $remember = $request->remember;
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $remember)) {
            return redirect()->route('home');
        }
        return redirect()->back()->with('error', 'Tên tài khoản hoặc mật khẩu không chính xác');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function userInfor()
    {

        return view('web.page.user');
    }

    public function userEdit()
    {

        return view('web.page.useredit');
    }

    public function updateUser(request $request, string $id)
    {


        $request->validate(
            [

                'email' => 'required|email',

                'password_new' => 'required',
                'password-confirm' => 'required|same:password_new',

            ],
            [
                'password_new.required' => 'Mật khẩu mới không được để trống',
                'password-confirm.required' => 'Mật khẩu xác nhận không khớp',
            ]
        );
        $user= User::find($id);
        $input = $request->all();
    if ($request->has('email')) {
        $user->email=$input['email'];

    }else{

    }
    if ($request->has('phone')) {
        $user->phone= $input['phone'];

    }else{

    }
    if ($request->has('password_new')) {
        $user->password= $input['password_new'];

    }else{

    }



    if($request->has('photo')){
        $destination = 'uploads/thumbs/'.$user->photo;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $file = $request->file('photo');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'-'.'user.'.$extention;
        $file->move('uploads/users/',$filename);
        $user->photo=$filename;

    }

        $user->save();
        Auth::logout();
        return redirect()->route('show-form-login')->with('success', 'Sửa thông tin thành công hãy đăng nhập lại');
    }



    // public function updatepassword(request $request){


    //     $request->validate([
    //         'password_old'=>'required|min:6|max:100',
    //         'password_new'=>'required|min:6|max:100',
    //         'password_comfirm'=>'required|same:password_new',
    //     ]);

    //     $user = auth()->user();
    // if(Hash::check($request->password_old,$user->password)){
    //     $user->update([
    //         'password'=>bcrypt($request->password_new)

    //     ]);
    //     return redirect()->back()->with('success','Sửa danh mục thành công');
    // }else{
    //     return redirect()->back()->with('error','Sửa danh mục thành công');
    // }

    public function userPayment()
    {

        return view('web.page.payment');
    }
}
