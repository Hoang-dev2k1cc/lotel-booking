<?php

namespace App\Http\Controllers\admin;
use App\Models\equipment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function adminEquipment(){
        return view('admin.equipment.equipment');
    }
    public function equipmentIndex()
  {
    $data = equipment::orderBy('id','DESC')->paginate(5);
    return view('admin.equipment.index',compact('data'));
  }

  public function equipmentCreate()
  {

    return view('admin.equipment.create');
  }
  public function equipmentStore(Request $request)
  {
    $request->validate(
        [

            'name' => 'required|unique:equipment',
        ],
        [
            'name.unique' => 'tiện ích đã tồn tại',
        ]
    );
    $input= $request->all();
    equipment::create($input);
     return redirect()->route('equipment.index')->with('success','Thêm mới danh mục thành công');
  }


  public function equipmentDestroy(equipment $Categories , string $id)
  {


        equipment::destroy($id);
      return redirect()->route('equipment.index')->with('success','Xóa danh mục thành công');

  }


  public function equipmentEdit(string $id)
  {

    $equipment = equipment::find($id);
    return view('admin.equipment.edit')->with('equipment',$equipment);
  }

  public function equipmentUpdate(Request $request,string $id)
  {

    $equipment = equipment::find($id);
    $input = $request->all();
    $equipment->update($input);
    return redirect()->back()->with('success','Sửa danh mục thành công');
  }
}
