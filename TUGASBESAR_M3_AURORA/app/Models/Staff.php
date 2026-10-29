<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'pegawai';
    public $timestamps = false;
    protected $fillable = ['nama', 'jabatan', 'kontak'];
}