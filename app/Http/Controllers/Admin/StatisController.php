<?php

namespace App\Http\Controllers\admin;

use App\Models\categories;
use App\Models\lotel;
use App\Models\province;
use App\Models\district;
use App\Models\commune;
use App\Models\room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class StatisController extends Controller
{
    public function statis()
    {
        $province = province::all();
        $hotels = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','province')
        ->where('lotels.id_category',1)
        ->get();
        $motels = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','lotels.province')
        ->where('lotels.id_category',3)
        ->get();
        $homestays = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','province')
        ->where('lotels.id_category',2)
        ->get();
        return view('admin.statis.statis', compact('hotels', 'motels', 'homestays','province'));
    }


    public function adminSearchHotel(Request $request )
    {
        $province = province::all();
        $hotels = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','province')
        ->where('lotels.id_category',1)
        ->get();
        $motels = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','lotels.province')
        ->where('lotels.id_category',3)
        ->get();
        $homestays = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','province')
        ->where('lotels.id_category',2)
        ->get();
        $hotel_id=$request->hotel_id;
        $data = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','province')
        ->where([
            ['lotels.id_category', '=', '1'],
            ['lotels.province', $request->hotel_id]
        ])
        ->get();
        $datas = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','province')
        ->where([
            ['lotels.id_category', '=', '1'],
            ['lotels.province', $request->hotel_id]
        ])
        ->paginate(5);


        return view('admin.statis.lotels', compact('data','datas','hotels', 'motels', 'homestays','province','hotel_id'));
    }

    public function adminSearchMotel(Request $request)
    {

        $province = province::all();
        $hotels = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','province')
        ->where('lotels.id_category',1)
        ->get();
        $motels = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','lotels.province')
        ->where('lotels.id_category',3)
        ->get();
        $homestays = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','province')
        ->where('lotels.id_category',2)
        ->get();
        $motel_id=$request->motel_id;
        $data = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','province')
        ->where([
            ['lotels.id_category', '=', '3'],
            ['lotels.province', $request->motel_id]
        ])
        ->get();
        $datas = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','province')
        ->where([
            ['lotels.id_category', '=', '3'],
            ['lotels.province', $request->motel_id]
        ])
        ->pagiante(5);



        return view('admin.statis.motels', compact('data','datas','hotels', 'motels', 'homestays','province','motel_id'));
    }

    public function adminSearchHomestay(Request $request)
    {

        $province = province::all();
        $hotels = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','province')
        ->where('lotels.id_category',1)
        ->get();
        $motels = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','lotels.province')
        ->where('lotels.id_category',3)
        ->get();
        $homestays = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','province')
        ->where('lotels.id_category',2)
        ->get();
        $homestay_id=$request->homestay_id;
        $data = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','province')
        ->where([
            ['lotels.id_category', '=', '2'],
            ['lotels.province', $request->homestay_id]
        ])
        ->get();
        $datas = DB::table('lotels')
        ->join('categories', 'categories.id', '=', 'lotels.id_category')
        ->join('province', 'province.id', '=', 'lotels.province')
        ->join('district', 'district.id', '=', 'lotels.district')
        ->join('commune', 'commune.id', '=', 'lotels.commune')
        ->select( 'name_category','thumb','lotels.lotel_name','address','province.name_province','district.name_district','commune.name_commune','categories.name_category','lotels.id','province')
        ->where([
            ['lotels.id_category', '=', '2'],
            ['lotels.province', $request->homestay_id]
        ])
        ->paginate(5);



        return view('admin.statis.homestay', compact('data','datas','hotels', 'motels', 'homestays','province','homestay_id'));
    }
    public function roomStatis(string $id)
    {
        $lotel = DB::table('lotels')->where('id', $id)->get();
        $data = room::orderBy('id', 'ASC')->where('id_lotel', $id)->paginate(5);
        $datas = room::orderBy('id', 'ASC')->where('id_lotel', $id)->get();
        return view('admin.statis.rooms', compact('data','datas', 'lotel'));
    }
}
