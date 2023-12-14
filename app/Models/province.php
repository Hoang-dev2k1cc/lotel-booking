<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class province extends Model
{
    use HasFactory;
    protected $table = 'province';
    protected $fillable = [
        'name_province',
    ];

    public function district()
    {

        return $this->hasMany(district::class,'id','id_province');
    }

}
