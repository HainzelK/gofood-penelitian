<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idmenu';

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
        'NamaMenu',
        'Harga',
        'IdResto',
    ];

    /**
     * Get the restaurant that owns the menu.
     */
public function menus() {
    // Ubah parameter ke-2 dari 'idrestoran' menjadi 'IdResto'
    return $this->hasMany(Menu::class, 'IdResto', 'idrestoran');
}
}
