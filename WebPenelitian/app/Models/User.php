<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi (Mass Assignment).
     * Sesuaikan dengan kolom yang ada di database Anda.
     */
    protected $fillable = [
        'name',
        'plotting',
        'domisili',
        'gender',
        'pendidikan',
        'kecamatan',
        'pekerjaan',
        'no_hp',
    ];

    /**
     * Karena tidak menggunakan password dan email, 
     * kita bisa menghapus hidden attributes dan casts bawaan.
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Jika Anda tidak menggunakan fitur login/auth standar Laravel,
     * Anda bisa membiarkan model ini tetap seperti ini.
     */
}