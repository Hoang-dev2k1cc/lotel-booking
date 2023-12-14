<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\DB;
use App\Models\handbook;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class HandbookController extends Controller
{
    public function handbookIndex()
    {
      $data = handbook::orderBy('id','DESC')->paginate(6);
      return view('admin.handbook.index',compact('data'));
    }


    public function handbookCreate()
    {

       $cats = handbook::all();
        return view('admin.handbook.create');

    }


    public function handbookStore(Request $request)
    {
        if($request->has('file_upload')){
            $file = $request->file_upload;
            $ext = $request->file_upload->extension();
            $file_name = time().'-'.'handbook.'.$ext;
            $file->move(public_path('uploads/handbooks'), $file_name);
        }
        $request->merge(['image'=> $file_name]);

        $input= $request->all();
        handbook::create($input);
     return redirect()->route('handbook.index')->with('success','Thêm mới handbook thành công');
    }

    public function handbookDestroy(handbook $handbook , string $id)
    {


        handbook::destroy($id);
        return redirect()->route('handbook.index')->with('success','Xóa handbook thành công');

    }


    public function handbookEdit(string $id)
    {

        $handbooks=DB::table('handbook')->where('id',$id)->get();
      return view('admin.handbook.edit',compact('handbooks'));




          // return view('admin.lotel.create',compact('cats'));

    }

    public function handbook()
    {
        $handbook = DB::table('handbook')->paginate(16);
        return view('web.page.handbook',compact('handbook'));
    }


    public function handbookUpdate(Request $request, string $id)
  {

    $handbook= handbook::find($id);
    $handbook->name= $request->input('name');
    $handbook->introduct= $request->input('introduct');
    $handbook->content= $request->input('content');


    if($request->has('image')){
        $destination = 'uploads/handbooks/'.$handbook->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $file = $request->file('image');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'-'.'handbook.'.$extention;
        $file->move('uploads/handbooks/',$filename);
        $handbook->image=$filename;

    }
    $handbook->save();
    return redirect()->back()->with('success','Sửa danh mục thành công');
  }

  public function handbookDetail(Request $request,$id ){
    $handbooks = handbook::orderBy('id','DESC')->paginate(6);
   $data= handbook::find($id);
    return view('web.page.handbookDetail',compact('data','handbooks'));
  }

}
