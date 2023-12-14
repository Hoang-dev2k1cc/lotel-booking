<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class district extends Model
{
    use HasFactory;
    protected $table = 'district';
    protected $fillable = [
        'name_district',
        'id_province',
    ];
    public function province()
    {

        return $this->belongsTo(province::class,'id','id_province');
    }

    public function commune()
    {

        return $this->hasMany(commune::class,'id','id_district');
    }
}
