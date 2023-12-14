<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commune extends Model
{
    use HasFactory;
    protected $table = 'commune';
    protected $fillable = [
        'name_commune',
        'id_district',
    ];


    public function district()
    {

        return $this->belongsTo(district::class,'id','id_district');
    }

}
