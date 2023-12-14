<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $table= 'booking';
    protected $fillable = [

        'username',
        'useremail',
        'userphone',
        'checkin',
        'checkout',
        'id_room',
        'id_lotel',
        'id_user',
        'code',
        'sum_time',
        'sum_price',
        'status',
        'updated_at',
        'created_at'
    ];


    public function room()

    {

        return $this->hasOne(room::class,'id','id_room');
    }
    public function user()

    {

        return $this->hasOne(User::class,'id','id_user');
    }
}
