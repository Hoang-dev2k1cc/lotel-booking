<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;

class room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = [
        'room_name',
        'room_number',
        'image',
        'image_list',
        'about',
        'childrens',
        'adults',
        'price',
        'status',
        'sevices',
        'id_lotel',
        'name_lotel',
        'updated_at',
        'created_at'
    ];

    public function lotels()
    {

        return $this->belongsTo(lotel::class,'id','id_lotel');
    }

    public function booking()
    {

        return $this->hasMany(booking::class,'id_room','id');
    }
}
