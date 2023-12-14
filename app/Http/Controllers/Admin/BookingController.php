<?php

namespace App\Http\Controllers\admin;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\booking;
use App\Models\room;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\lotel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function bookingStore(Request $request, $id)
    {

        $code = $request->code;

        $code_name =$code .time();
        $request->merge(['code'=> $code_name]);

        $input = $request->all();
        booking::create($input);
        $id = Auth::user()->id;
        return redirect()->route('history', compact('id'))->with('success', 'Đặt phòng thành công');
    }

    public function bookingConfirm(Request $request, string $id)
    {

        $booking=booking::find($id);

        DB::table('booking')
            ->where('id', $id)
            ->update(['status' => 1]);
        $id = Auth::user()->id;
        return redirect()->back()->with('success', 'Xác nhận thành công');
    }

    public function bookingCancel(Request $request, string $id)
    {
        DB::table('booking')
            ->where('id', $id)
            ->update(['status' => 3]);
        $booking = booking::find($id);
        $id_room = $booking->id_room;
        DB::table('rooms')
            ->where('id', $id_room)
            ->update(['status' => 0]);
        $id = Auth::user()->id;
        return redirect()->back()->with('success', 'Hủy thành công');
    }

    public function bookingPayment(Request $request, string $id)
    {
        DB::table('booking')
            ->where('id', $id)
            ->update(['status' => 2]);
        $id = Auth::user()->id;
        return redirect()->back()->with('success', 'Xác nhận thành công');
    }

    public function bookingRefuse(Request $request, string $id)
    {
        DB::table('booking')
            ->where('id', $id)
            ->update(['status' => 4]);
        $id = Auth::user()->id;
        return redirect()->back()->with('success', 'Từ chối thành công');
    }


    public function orderNew()
    {
        $data = booking::orderBy('id','DESC')
            ->join('rooms', 'rooms.id', '=', 'booking.id_room')
            ->join('lotels', 'lotels.id', '=', 'booking.id_lotel')
            ->select('username', 'useremail', 'userphone', 'checkin', 'checkout', 'booking.created_at', 'rooms.room_name', 'rooms.room_number', 'lotels.lotel_name', 'rooms.price', 'booking.sum_price', 'booking.status', 'booking.id', 'booking.sum_time','booking.code')
            ->where('booking.status', '=', 0)
            ->paginate(5);
        return view('admin.order.new', compact('data'));
    }


    public function orderProfile()
    {
        $data = booking::orderBy('id','DESC')
            ->join('rooms', 'rooms.id', '=', 'booking.id_room')
            ->join('lotels', 'lotels.id', '=', 'booking.id_lotel')
            ->select('username', 'useremail', 'userphone', 'checkin', 'checkout', 'booking.created_at', 'rooms.room_name', 'rooms.room_number', 'lotels.lotel_name', 'rooms.price', 'booking.sum_price', 'booking.status', 'booking.id', 'booking.sum_time','booking.code')
            ->whereBetween('booking.status', [2, 4])
            ->paginate(5);
        return view('admin.order.profile', compact('data'));
    }

    public function orderPayment()
    {
        $data = booking::orderBy('id','DESC')
            ->join('rooms', 'rooms.id', '=', 'booking.id_room')
            ->join('lotels', 'lotels.id', '=', 'booking.id_lotel')
            ->select('booking.code','username', 'useremail', 'userphone', 'checkin', 'checkout', 'booking.created_at', 'rooms.room_name', 'rooms.room_number', 'lotels.lotel_name', 'rooms.price', 'booking.sum_price', 'booking.status', 'booking.id', 'booking.sum_time')
            ->where('booking.status', '=', 1)
            ->paginate(5);
        return view('admin.order.payment', compact('data'));
    }


    public function bookingDestroy(Lotel $lotel, string $id)
    {


        $booking = booking::find($id);
        $item = booking::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Xóa đơn thành công');
    }



    public function searchNew( Request $request)
    {
        $data = DB::table('booking')
            ->join('rooms', 'rooms.id', '=', 'booking.id_room')
            ->join('lotels', 'lotels.id', '=', 'booking.id_lotel')
            ->select('username', 'useremail', 'userphone', 'checkin', 'checkout', 'booking.created_at', 'rooms.room_name', 'rooms.room_number', 'lotels.lotel_name', 'rooms.price', 'booking.sum_price', 'booking.status', 'booking.id', 'booking.sum_time','booking.code')
            ->where('booking.status', '=', 0)
            ->whereBetween('booking.created_at', [$request->start, $request->finish])
            ->paginate(5);
        return view('admin.order.new', compact('data'));
    }

    public function searchPay( Request $request)
    {
        $data = DB::table('booking')
            ->join('rooms', 'rooms.id', '=', 'booking.id_room')
            ->join('lotels', 'lotels.id', '=', 'booking.id_lotel')
            ->select('username', 'useremail', 'userphone', 'checkin', 'checkout', 'booking.created_at', 'rooms.room_name', 'rooms.room_number', 'lotels.lotel_name', 'rooms.price', 'booking.sum_price', 'booking.status', 'booking.id', 'booking.sum_time','booking.code')
            ->where('booking.status', '=', 1)
            ->whereBetween('booking.created_at', [$request->start, $request->finish])
            ->paginate(5);
        return view('admin.order.payment', compact('data'));
    }

    public function searchOrder( Request $request)
    {
        $data = DB::table('booking')
            ->join('rooms', 'rooms.id', '=', 'booking.id_room')
            ->join('lotels', 'lotels.id', '=', 'booking.id_lotel')
            ->select('username', 'useremail', 'userphone', 'checkin', 'checkout', 'booking.created_at', 'rooms.room_name', 'rooms.room_number', 'lotels.lotel_name', 'rooms.price', 'booking.sum_price', 'booking.status', 'booking.id', 'booking.sum_time','booking.code')
            ->whereBetween('booking.status', [2, 4])
            ->whereBetween('booking.created_at', [$request->start, $request->finish])
            ->paginate(5);
        return view('admin.order.profile', compact('data'));
    }

}
