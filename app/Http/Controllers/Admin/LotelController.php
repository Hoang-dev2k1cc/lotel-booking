<?php

namespace App\Http\Controllers\admin;
use App\Models\categories;
use App\Models\lotel;
use App\Models\province;
use App\Models\district;
use App\Models\commune;
use App\Models\equipment;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LotelController extends Controller
{

    public function lotelIndex()
    {
        $data =lotel::orderBy('id', 'DESC')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id')
        ->paginate(5);
        return view('admin.lotel.index',compact('data'));
    }

    public function lotelCreate()
    {

       $cats = categories::all();
       $district = district::all();
       $province = province::all();
       $commune = commune::all();
       $equipment = equipment::orderBy('id', 'DESC')->get();
        return view('admin.lotel.create',compact('cats','district','commune','province','equipment'));

    }

    public function lotelStore(Request $request)
    {
        if($request->has('file_upload')){
            $file = $request->file_upload;
            $ext = $request->file_upload->extension();
            $file_name = time().'-'.'thumb.'.$ext;
            $file->move('uploads/thumbs', $file_name);
        }
        $request->merge(['thumb'=> $file_name]);

        $image = array();
        if($files = $request->file('image_list')){

           foreach ($files as $file){
           $image_name=md5(rand(1000,10000));
           $ext = $file->getClientOriginalExtension();
           $file_name = $image_name.'-' . 'details.' . $ext;
           $upload_path = 'uploads/details/';
           $image_url=$file_name;
           $file->move($upload_path, $file_name);
           $image[]= $image_url;
           }
        }

        $input= $request->all();
        $input["image_list"] =implode('|',$image);
        $input["equipment"] = implode(' , ', $input["equipment"]);
        lotel::create($input);
     return redirect()->route('lotel.index')->with('success','Thêm mới danh mục thành công');
    }

    public function lotelDestroy( string $id)
  {


    $Lotel=Lotel::find($id);
            if($Lotel->room->count() > 0){
                return redirect()->route('lotel.index')->with('error','Không thể xóa cơ sở này');
            }else{
                Lotel::destroy($id);
                return redirect()->route('lotel.index')->with('success','Xóa cơ sở thành công');
            }

  }

  public function lotelEdit(string $id)
  {

    $data=DB::table('lotels')->where('lotels.id',$id)
    ->join('province', 'province.id', '=', 'lotels.province')
    ->join('district', 'district.id', '=', 'lotels.district')
    ->join('commune', 'commune.id', '=', 'lotels.commune')
    ->select('lotels.lotel_name','lotels.id','lotels.id_category','lotels.introduct','lotels.equipment','lotels.thumb','lotels.image_list','lotels.address','lotels.contact','lotels.located','province.name_province','district.name_district','commune.name_commune','lotels.province','lotels.district','lotels.commune','lotels.price_day','lotels.person')
    ->get();
    $district = district::all();
    $province = province::all();
    $commune = commune::all();
    $cats = categories::all();
    $equipment = equipment::orderBy('id', 'ASC')->get();
    return view('admin.lotel.edit',compact('data','cats','district','commune','province','equipment'));




        // return view('admin.lotel.create',compact('cats'));

  }

  public function lotelUpdate(Request $request, string $id)
  {

    $lotel= lotel::find($id);
    $input = $request->all();
    if ($request->has('equipment')) {
        $lotel->equipment=$input["equipment"] = implode(' , ', $input["equipment"]);
    }else{

    }
    if ($request->has('province')) {
        $lotel->province=$input['province'];

    }else{

    }
    if ($request->has('district')) {
        $lotel->district= $input['district'];

    }else{

    }
    if ($request->has('commune')) {
        $lotel->commune= $input['commune'];

    }
    if ($request->has('address')) {
       $lotel->address= $input['address'];

    }else{

    }
  $lotel->lotel_name= $request->input('lotel_name');

    $lotel->introduct= $request->input('introduct');
    $lotel->contact= $request->input('contact');

    $lotel->located= $request->input('located');
    $lotel->id_category= $request->input('id_category');
    $lotel->price_day= $request->input('price_day');
    if($request->has('thumb')){
        $destination = 'uploads/thumbs/'.$lotel->thumb;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $file = $request->file('thumb');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'-'.'thumb.'.$extention;
        $file->move('uploads/thumbs/',$filename);
        $lotel->thumb=$filename;

    }
    if ($request->has('image_list')) {
        $destination = 'uploads/details/' . $lotel->image_list;
        if (File::exists($destination)) {
            File::delete($destination);
        }
    $image = array();
    if($files = $request->file('image_list')){
        foreach ($files as $file){
        $image_name=md5(rand(1000,10000));
        $ext = $file->getClientOriginalExtension();
        $file_name = $image_name.'-' . 'details.' . $ext;
        $upload_path = 'uploads/details/';
        $image_url=$file_name;
        $file->move($upload_path, $file_name);
        $image[]= $image_url;
        }
     }
     $image_list =implode('|',$image);
     $lotel->image_list=$image_list;
    }


    $lotel->save();

    return redirect()->back()->with('success','Sửa danh mục thành công');

}

  public function typeLotel(string $type)
    {
        // $data = lotel::orderBy('id','DESC')->paginate(8);


       $name_type=DB::table('categories')->where('id','=',$type)->paginate();
       $data = DB::table('lotels')
       ->join('categories', 'categories.id', '=', 'lotels.id_category')
       ->join('province', 'province.id', '=', 'lotels.province')
       ->join('district', 'district.id', '=', 'lotels.district')
       ->join('commune', 'commune.id', '=', 'lotels.commune')->where('lotels.id_category',$type)
       ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','lotels.id_category','lotels.price_day')
       ->paginate(12);

        return view('web.page.type',compact('data','name_type'));

    }

    public function lotelSearch(Request $request)
    {
        $data = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id')
        ->where('lotels.lotel_name','like','%'.$request->key.'%')
        ->orWhere('province.name_province','like','%'.$request->key.'%')
        ->paginate(5);
        return view('admin.lotel.search',compact('data'));

    }





}
