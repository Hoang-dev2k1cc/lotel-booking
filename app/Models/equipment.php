<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipment extends Model
{    protected $table = 'equipment';
    use HasFactory;
    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];
}
