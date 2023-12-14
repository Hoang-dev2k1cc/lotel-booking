<?php

namespace App\Http\Controllers\admin;
use App\Models\rooms;
use App\Models\booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade\Pdf;


class HistoryController extends Controller
{
    public function history($id){


        $data = DB::table('booking')->where('id_user',$id)
        ->join('rooms', 'rooms.id', '=', 'booking.id_room')
        ->join('lotels', 'lotels.id', '=', 'rooms.id_lotel')
        ->select( 'username','useremail','userphone','checkin','checkout','booking.created_at','rooms.room_name','rooms.room_number','lotels.lotel_name','rooms.price','booking.sum_price','booking.status','booking.id','booking.code')
        ->get();
        return view('web.page.history',compact('data'));
    }



}
