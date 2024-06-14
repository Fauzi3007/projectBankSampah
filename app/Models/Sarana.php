<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarana extends Model
{
    use HasFactory;

    protected $table = 'saranas';
    protected $primaryKey = 'id_sarana';
    protected $fillable = ['nama_sarana', 'alamat_sarana','provinsi_id_provinsi', 'jenis_sarana','nama_admin'];
    public $timestamps = true;

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id_provinsi');
    }

    public function perhitungan_sampah()
    {
        return $this->hasMany(PerhitunganSampah::class, 'sarana_id_sarana');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nama_admin');
    }


}
