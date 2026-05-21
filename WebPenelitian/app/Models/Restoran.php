<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restoran extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'restoran';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idrestoran';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Nama',
        'Jenis',
    ];

    /**
     * Get the menus for the restaurant.
     */
public function menus() {
    // Ubah parameter kedua dari 'idrestoran' menjadi 'IdResto'
    return $this->hasMany(Menu::class, 'IdResto', 'idrestoran');
}
}
