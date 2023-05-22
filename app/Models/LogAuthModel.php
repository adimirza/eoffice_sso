<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAuthModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'log_auth';
    protected $fillable = [
        'nip',
        'token',
        'status',
        'terakhir_login',
        'ip',
        'latitude',
        'longitude',
    ];
}
