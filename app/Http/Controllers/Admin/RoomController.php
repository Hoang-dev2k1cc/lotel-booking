<?php

namespace App\Http\Controllers\admin;

use App\Models\lotel;
use App\Models\room;
use App\Models\booking;
use App\Models\equipment;
use App\Models\MultipleImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RoomController extends Controller
{
    public function roomIndex(string $id)
    {
        $lotel = DB::table('lotels')->where('id', $id)->get();
        $data = room::orderBy('id', 'ASC')->where('id_lotel', $id)->paginate(5);
        return view('admin.room.index', compact('data', 'lotel'));
    }
    public function roomCreate(string $id)
    {
        $lotel = DB::table('lotels')->where('id', $id)
        ->get();
        return view('admin.room.create', compact('lotel'));

    }

    public function roomStore(Request $request, string $id)
    {

        if ($request->has('file_upload')) {
            $file = $request->file_upload;
            $ext = $request->file_upload->extension();
            $file_name = time() . '-' . 'room.' . $ext;
            $file->move('uploads/rooms', $file_name);
        }
        $request->merge(['image' => $file_name]);

        $image = array();
        if ($files = $request->file('image_list')) {
            foreach ($files as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = $file->getClientOriginalExtension();
                $file_name = $image_name . '-' . 'room.' . $ext;
                $upload_path = 'uploads/rooms/';
                $image_url = $file_name;
                $file->move($upload_path, $file_name);
                $image[] = $image_url;
            }
        }
        $input = $request->all();
        $input["image_list"] = implode('|', $image);

        $input["sevices"] = implode(' , ', $input["sevices"]);
        $lotel = lotel::find($id);
        $id = $lotel->id;
        room::create($input);

        return redirect()->route('room.index', ['id' => $id,])->with('success', 'Thêm phòng mới thành công');
    }

    public function roomEdit(string $id)
    {

        $data = DB::table('rooms')->where('rooms.id', $id)
        ->join('lotels','lotels.id','=','rooms.id_lotel')
        ->select('rooms.room_name','rooms.sevices','rooms.room_number','rooms.price','rooms.sevices','rooms.adults','rooms.childrens','rooms.image','rooms.image_list','lotels.lotel_name','rooms.id','rooms.about','rooms.id_lotel','lotels.equipment')
        ->get();
        return view('admin.room.edit', compact('data'));
    }

    public function roomUpdate(Request $request, $id)
    {

        $room = room::find($id);
        $room->room_name = $request->input('room_name');
        $room->room_number = $request->input('room_number');
        $room->about = $request->input('about');
        $room->price = $request->input('price');
        $room->adults = $request->input('adults');
        $room->childrens = $request->input('childrens');





        if ($request->has('image')) {
            $destination = 'uploads/rooms/' . $room->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '-' . 'room.' . $extention;
            $file->move('uploads/rooms/', $filename);
            $room->image = $filename;
        }
        if ($request->has('image_list')) {
            $destination = 'uploads/rooms/' . $room->image_list;
            if (File::exists($destination)) {
                File::delete($destination);
            }
        $image = array();
        if ($files = $request->file('image_list')) {
            foreach ($files as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = $file->getClientOriginalExtension();
                $file_name = $image_name . '-' . 'room.' . $ext;
                $upload_path = 'uploads/rooms/';
                $image_url = $file_name;
                $file->move($upload_path, $file_name);
                $image[] = $image_url;
            }
        }
        $room->image_list=$input["image_list"] = implode('|', $image);
    }
        $input = $request->all();
        if ($request->has('sevices')) {
            $room->sevices=$input["sevices"] = implode(' , ', $input["sevices"]);
        }


        $room->save();

        return redirect()->back()->with('success', 'Sửa thông tin phòng thành công');
    }

    public function roomDestroy(string $id)
    {
        $room = room::find($id);
        $id_lotel = $room->id_lotel;
        if(!empty($room->booking)){
            return redirect()->route('room.index', ['id' => $id_lotel])->with('error', 'Không thể xóa phòng');
          }else{
            room::destroy($id);
            return redirect()->route('room.index', ['id' => $id_lotel])->with('success', 'xóa phòng thành công');
        }

    }

    public function room(string $id)
    {
        $lotel = DB::table('lotels')->where('id', $id)->get();
        $data = room::orderBy('id', 'ASC')->where([
            ['status', '=', '0'],
            ['id_lotel', $id],
        ])->get();
        $sevices = DB::table('rooms')->select('sevices')->where('id_lotel', $id)->get();

        $sevices = json_encode($sevices);
        return view('web.page.room', compact('data', 'lotel', 'sevices'));
    }

    public function roomFillter(string $id,$checkin,$checkout)
    {
        $lotel = DB::table('lotels')->where('id', $id)->get();

        // $room = room::orderBy('id', 'ASC') ->where('rooms.id_lotel',$id)
        // ->select('rooms.room_number','rooms.room_name','rooms.about','rooms.price','rooms.adults','rooms.childrens','rooms.id','rooms.image','rooms.sevices');
        $data = room::orderBy('id', 'ASC') ->where('rooms.id_lotel',$id)
        ->Join('booking','booking.id_room','=','rooms.id')
        ->orWhere([
            ['booking.checkin', '<>', $checkin],
            ['booking.checkout', '<>', $checkout]
        ])
        ->select('rooms.room_number','rooms.room_name','rooms.about','rooms.price','rooms.adults','rooms.childrens','rooms.id','rooms.image','rooms.sevices')
        // ->union($room)
        ->get();



        return view('web.page.room', compact('data', 'lotel', ));
    }

    public function disable(string $id){
        DB::table('rooms')
        ->where('id', $id)
        ->update(['status' => 1]);
        return redirect()->back()->with('error', 'Vô hiệu hóa thành công');
    }

    public function able(string $id){
        DB::table('rooms')
        ->where('id', $id)
        ->update(['status' => 0]);
        return redirect()->back()->with('success', 'Thay đổi thành công');
    }
}
