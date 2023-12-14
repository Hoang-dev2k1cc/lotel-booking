<?php

namespace App\Http\Controllers\admin;


use App\Models\rooms;
use App\Models\booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
class BillController extends Controller
{
    public function print_order($id)
    {
        $data = DB::table('booking')->where('booking.id',$id)
        ->join('rooms', 'rooms.id', '=', 'booking.id_room')
        ->join('lotels', 'lotels.id', '=', 'booking.id_lotel')
        ->select( 'username','useremail','userphone','checkin','checkout','booking.created_at','rooms.room_name','rooms.room_number','lotels.lotel_name','rooms.price','booking.sum_price','booking.status','booking.id','booking.code')
        ->get();

      $pdf = PDF::loadView('web.page.pdf_view',compact('data'))->setOptions(['defaultFont' => 'sans-serif']);;
      return $pdf->stream();


    }
}
