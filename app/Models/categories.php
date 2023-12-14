<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;
    protected $table= 'categories';
    protected $fillable = ['id','name_category','created_at'];

    public function lotels()
    {

        return $this->hasMany(lotel::class,'id_category','id');
    }
}
