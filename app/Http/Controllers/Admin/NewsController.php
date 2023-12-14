<?php

namespace App\Http\Controllers\admin;

use App\Models\news;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class NewsController extends Controller
{
    public function news()
    {
        $news = DB::table('news')->paginate(4);
        return view('web.page.news',compact('news'));
    }



    public function newsIndex()
    {
      $data = news::orderBy('id','DESC')->paginate(6);
      return view('admin.news.index',compact('data'));
    }


    public function newsCreate()
    {

       $cats = news::all();
        return view('admin.news.create');

    }


    public function newsStore(Request $request)
    {
        if($request->has('file_upload')){
            $file = $request->file_upload;
            $ext = $request->file_upload->extension();
            $file_name = time().'-'.'new.'.$ext;
            $file->move(public_path('uploads/news'), $file_name);
        }
        $request->merge(['image'=> $file_name]);

        $input= $request->all();
        news::create($input);
     return redirect()->route('news.index')->with('success','Thêm mới tin tức thành công');
    }

    public function newsDestroy(news $news , string $id)
    {


        news::destroy($id);
        return redirect()->route('news.index')->with('success','Xóa tin tức thành công');

    }


    public function newsEdit(string $id)
    {

        $news=DB::table('news')->where('id',$id)->get();

      return view('admin.news.edit',compact('news'));




          // return view('admin.lotel.create',compact('cats'));

    }



    public function newsUpdate(Request $request, string $id)
  {

    $new= news::find($id);
    $new->name= $request->input('name');
    $new->introduct= $request->input('introduct');
    $new->content= $request->input('content');


    if($request->has('image')){
        $destination = 'uploads/news/'.$new->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $file = $request->file('image');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'-'.'new.'.$extention;
        $file->move('uploads/news/',$filename);
        $new->image=$filename;

    }
    $new->save();
    return redirect()->back()->with('success','Sửa tin tức thành công');
  }

  public function newsDetail(Request $request,$id ){
    $news = news::orderBy('id','DESC')->paginate(6);
   $data= news::find($id);
    return view('web.page.newsDetail',compact('data','news'));
  }

}
