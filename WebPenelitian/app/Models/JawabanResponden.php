<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanResponden extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jawaban_responden';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'NoJawab';

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
        'Tanggal',
        'IS',
        'Nama',
        'Gender',
        'Usia',
        'PendidikanTerakhir',
        'DaerahDomisili',
        'Kecamatan',
        'Pekerjaan',
        'NoHP',
        'Plotting',
        'Saldo',
        'MenuMakanan',
        'MenuMinuman',
        'Subsidi/Insentif',
        'Pajak',
        'Total',
        'TopUp',
        'TIME_CASE_PRES',
        'TIME_ALL',
    ];
}
