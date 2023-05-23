<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpModel extends Model
{
    use HasFactory;
    protected $table = 'sp';
    protected $fillable = [
        'nama',
        'kode',
        'url',
        'url_login',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
