<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;

    protected $table = 'kotas';
    protected $primaryKey = 'id_kota';
    protected $fillable = ['nama_kota', 'provinsi_id_provinsi'];
    public $timestamps = true;

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id_provinsi');
    }
}
