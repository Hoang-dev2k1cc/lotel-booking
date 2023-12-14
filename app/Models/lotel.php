<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;

class lotel extends Model
{
    use HasFactory;
    protected $table = 'lotels';
    protected $fillable = [
        'id',
        'lotel_name',
        'introduct',
        'id_category',
        'address',
        'thumb',
        'image_list',
        'price_day',
        'province',
        'district',
        'commune',
        'person',
        'equipment',
        'located',
        'contact',
        'updated_at',
        'created_at'
    ];

    public function categories()
    {

        return $this->belongsTo(categories::class,'id','id_category');
    }

    public function room()
    {

        return $this->hasMany(room::class,'id_lotel','id');
    }


}
