<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;
    protected $table= 'roles';
    protected $fillable = ['id','name','created_at'];

    public function users()
    {

        return $this->hasMany(User::class,'role','id');
    }
}
