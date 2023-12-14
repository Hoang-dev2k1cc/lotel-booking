<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\location;
use App\Http\Controllers\Controller;
class LocationController extends Controller
{
    public function locationIndex()
    {
      $data = location::orderBy('id','DESC')->paginate();
      return view('admin.location.index',compact('data'));
    }

    public function locationCreate()
    {

        return view('admin.location.create');

    }

    public function locationStore(Request $request)
    {
        if($request->has('file_upload')){
            $file = $request->file_upload;
            $ext = $request->file_upload->extension();
            $file_name = time().'-'.'location.'.$ext;
            $file->move(public_path('uploads/locations'), $file_name);
        }
        $request->merge(['image'=> $file_name]);

        $input= $request->all();
        location::create($input);
     return redirect()->route('location.index')->with('success','Thêm mới location thành công');
    }
    public function locationDestroy(location $location , string $id)
    {


        location::destroy($id);
        return redirect()->route('location.index')->with('success','Xóa tin tức thành công');

    }


    public function locationEdit(string $id)
    {

        $location=DB::table('location')->where('id',$id)->get();

      return view('admin.location.edit',compact('location'));




          // return view('admin.lotel.create',compact('cats'));

    }



    public function locationUpdate(Request $request, string $id)
  {

    $location= location::find($id);
    $location->name= $request->input('name');
    $location->link= $request->input('link');



    if($request->has('image')){
        $destination = 'uploads/locations/'.$location->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $file = $request->file('image');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'-'.'location.'.$extention;
        $file->move('uploads/locations/',$filename);
        $location->image=$filename;

    }
    $location->save();
    return redirect()->back()->with('success','Sửa tin tức thành công');
  }
}
