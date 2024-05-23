<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarana extends Model
{
    use HasFactory;

    protected $table = 'saranas';
    protected $primaryKey = 'id_sarana';
    protected $fillable = ['nama_sarana', 'alamat_sarana','provinsi_id_provinsi', 'jenis_sarana'];
    public $timestamps = true;



    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id_provinsi');
    }
}
