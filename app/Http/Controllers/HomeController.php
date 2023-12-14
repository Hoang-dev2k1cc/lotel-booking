<?php

namespace App\Http\Controllers;

use App\Models\lotel;
use App\Models\lotel_details;
use App\Models\location;
use App\Models\news;
use App\Models\room;
use App\Models\handbook;
use Illuminate\Http\Request;
use App\Models\categories;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {


        $handbook = DB::table('handbook')->paginate(3);
        $location = DB::table('location')->get();
        $news = DB::table('news')->paginate(4);
        $data = DB::table('lotels')
            ->join('categories', 'categories.id', '=', 'lotels.id_category')
            ->join('province', 'province.id', '=', 'lotels.province')
            ->join('district', 'district.id', '=', 'lotels.district')
            ->join('commune', 'commune.id', '=', 'lotels.commune')
            ->select('name_category', 'thumb', 'lotels.lotel_name', 'address', 'province.name_province', 'district.name_district', 'commune.name_commune', 'categories.name_category', 'lotels.id', 'lotels.id_category','price_day')
            ->paginate(16);
        return view('web.home', compact('data', 'handbook', 'news', 'location'));
    }
    public function search(Request $request)
    {
        $handbook = DB::table('handbook')->paginate(3);
        $location = DB::table('location')->get();
        $news = DB::table('news')->paginate(4);
        $data = DB::table('lotels')
            ->join('categories', 'categories.id', '=', 'lotels.id_category')
            ->join('province', 'province.id', '=', 'lotels.province')
            ->join('district', 'district.id', '=', 'lotels.district')
            ->join('commune', 'commune.id', '=', 'lotels.commune')
            ->select('name_category', 'thumb', 'lotels.lotel_name', 'address', 'province.name_province', 'district.name_district', 'commune.name_commune', 'categories.name_category', 'lotels.id', 'lotels.id_category','lotels.price_day')
            ->where('lotels.lotel_name', 'like', '%' . $request->key . '%')
            ->orWhere('province.name_province', 'like', '%' . $request->key . '%')
            ->orWhere('commune.name_commune', 'like', '%' . $request->key . '%')
            ->orWhere('district.name_district', 'like', '%' . $request->key . '%')
            ->orWhere('categories.name_category', 'like', '%' . $request->key . '%')
            ->orWhere('lotels.price_day', '<=', $request->key )
            ->paginate(15);
        return view('web.home', compact('data', 'handbook', 'news', 'location'));
    }

    public function fillter(Request $request)
    {

        if ($request->has('equipment')) {
            $input= $request->all();
            $input["equipment"] = implode(' , ', $input["equipment"]);
            $a = $request->adults;
            $b = $request->childrens;
            $handbook = DB::table('handbook')->paginate(3);
            $location = DB::table('location')->get();
            $news = DB::table('news')->paginate(4);
            $data = DB::table('lotels')
                ->join('categories', 'categories.id', '=', 'lotels.id_category')
                ->join('province', 'province.id', '=', 'lotels.province')
                ->join('district', 'district.id', '=', 'lotels.district')
                ->join('commune', 'commune.id', '=', 'lotels.commune')

                ->where([
                    ['lotels.person','>=', $a+$b],
                    ['categories.id', $request->id_category],
                    ['province.name_province',$request->province],
                    ['lotels.equipment','like', '%' . $input["equipment"] . '%'],

                ])
                ->whereBetween('price_day', [$request->min,$request->max])
                ->orWhere([
                    ['lotels.person','>=', $a+$b],
                    ['categories.id', $request->id_category],
                    ['district.name_district',$request->province],
                    ['lotels.equipment','like', '%' . $input["equipment"] . '%'],
                ])
                ->whereBetween('price_day', [$request->min,$request->max])
                ->orWhere([
                    ['lotels.person','>=', $a+$b],
                    ['categories.id', $request->id_category],
                    ['commune.name_commune',$request->province],
                    ['lotels.equipment','like', '%' . $input["equipment"] . '%'],
                ])
                ->whereBetween('price_day', [$request->min,$request->max])
                ->select('name_category', 'thumb', 'lotels.lotel_name', 'address', 'province.name_province', 'district.name_district', 'commune.name_commune', 'categories.name_category', 'lotels.id', 'lotels.id_category','price_day')
                ->paginate(16);
                return view('web.home', compact('data', 'handbook', 'news', 'location'));
          }else{


        $a = $request->adults;
        $b = $request->childrens;
        $checkin = $request->checkin;
        $checkout = $request->checkout;
        $booking = DB::table('booking')->where([
            ['checkin',$checkin],
            ['checkout',$checkout],
            ])->get();
        $handbook = DB::table('handbook')->paginate(3);
        $location = DB::table('location')->get();
        $news = DB::table('news')->paginate(4);
        $data = DB::table('lotels')
            ->join('categories', 'categories.id', '=', 'lotels.id_category')
            ->join('province', 'province.id', '=', 'lotels.province')
            ->join('district', 'district.id', '=', 'lotels.district')
            ->join('commune', 'commune.id', '=', 'lotels.commune')

            ->where([
                ['lotels.person','>=', $a+$b],
                ['categories.id', $request->id_category],
                ['province.name_province',$request->province],
            ])
            ->whereBetween('price_day', [$request->min,$request->max])
            ->orWhere([
                ['lotels.person','>=', $a+$b],
                ['categories.id', $request->id_category],
                ['district.name_district',$request->province],
            ])
            ->whereBetween('price_day', [$request->min,$request->max])
            ->orWhere([
                ['lotels.person','>=', $a+$b],
                ['categories.id', $request->id_category],
                ['commune.name_commune',$request->province],
            ])
            ->whereBetween('price_day', [$request->min,$request->max])
            ->select('name_category', 'thumb', 'lotels.lotel_name', 'address', 'province.name_province', 'district.name_district', 'commune.name_commune', 'categories.name_category', 'lotels.id', 'lotels.id_category','price_day')
            ->paginate(16);
        return view('web.home', compact('data', 'handbook', 'news', 'location','checkin','checkout'));

    }
}

    public function lotelDetail(string $id)
    {


        $data = DB::table('lotels')->where('lotels.id', '=', $id)
            ->join('categories', 'categories.id', '=', 'lotels.id_category')
            ->join('province', 'province.id', '=', 'lotels.province')
            ->join('district', 'district.id', '=', 'lotels.district')
            ->join('commune', 'commune.id', '=', 'lotels.commune')
            ->select('name_category', 'thumb', 'lotels.lotel_name', 'address', 'province.name_province', 'district.name_district', 'commune.name_commune', 'categories.name_category', 'lotels.id', 'lotels.id_category', 'lotels.located', 'image_list', 'introduct', 'contact','lotels.province','lotels.person','lotels.equipment','lotels.price_day')

            ->get();
            $lotel = lotel::find($id);
            $id_address=$lotel->province;
            $same = DB::table('lotels')->where('province',$id_address)->get();

        return view('web.page.loteldetail', compact('data','same'));
    }

    public function lotelDetailFillter(string $id,$checkin,$checkout  )
    {
        $checkout;
        $checkin;

        $data = DB::table('lotels')->where('lotels.id', '=', $id)
            ->join('categories', 'categories.id', '=', 'lotels.id_category')
            ->join('province', 'province.id', '=', 'lotels.province')
            ->join('district', 'district.id', '=', 'lotels.district')
            ->join('commune', 'commune.id', '=', 'lotels.commune')
            ->select('name_category', 'thumb', 'lotels.lotel_name', 'address', 'province.name_province', 'district.name_district', 'commune.name_commune', 'categories.name_category', 'lotels.id', 'lotels.id_category', 'lotels.located', 'image_list', 'introduct', 'contact','lotels.province','lotels.person','lotels.equipment','lotels.price_day')

            ->get();
            $lotel = lotel::find($id);
            $id_address=$lotel->province;
            $same = DB::table('lotels')->where('province',$id_address)->get();

        return view('web.page.loteldetail', compact('data','same','checkin','checkout'));
    }

    public function booking($id)
    {
        $room = room::find($id);

        $price = $room->price;

        return view('web.page.booking', compact('price', 'room'));
    }
}
