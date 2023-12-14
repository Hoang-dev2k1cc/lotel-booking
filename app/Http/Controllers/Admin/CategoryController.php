<?php

namespace App\Http\Controllers\admin;

use App\Models\categories;
use App\Models\lotel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function adminCategory(){
        return view('admin.category.category');
    }
    public function categoryIndex()
  {
    $data = Categories::orderBy('id','DESC')->paginate(4);
    return view('admin.category.index',compact('data'));
  }

  public function categoryCreate()
  {

    return view('admin.category.create');
  }
  public function categoryStore(Request $request)
  {
    $request->validate(
        [

            'name_category' => 'required|unique:categories',
        ],
        [
            'name_category.unique' => 'loại hình đã tồn tại',
        ]
    );
    $input= $request->all();
    categories::create($input);
     return redirect()->route('category.index')->with('success','Thêm mới danh mục thành công');
  }


  public function categoryDestroy(string $id)
  {
    $Categories=categories::find($id);
    if($Categories->lotels->count() >0){
      return redirect()->route('category.index')->with('error','không thể xóa danh mục này');
    }else{
      Categories::destroy($id);
      return redirect()->route('category.index')->with('success','Xóa danh mục thành công');
    }
  }


  public function categoryEdit(string $id)
  {

    $categories = categories::find($id);
    return view('admin.category.edit')->with('categories',$categories);
  }

  public function categoryUpdate(Request $request,string $id)
  {

    $categories = categories::find($id);

    $categories->name_category= $request->input('name');
    $categories->save();
    return back()->with('success','Sửa danh mục thành công');
  }

}
