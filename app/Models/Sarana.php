<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarana extends Model
{
    use HasFactory;

    protected $table = 'saranas';
    protected $primaryKey = 'id_sarana';
    protected $fillable = ['nama_sarana', 'alamat_sarana','provinsi', 'jenis_sarana', 'pengguna_sarana_id_pengguna_sarana'];
    public $timestamps = true;

    public function pengguna_sarana()
    {
        return $this->belongsTo(PenggunaSarana::class, 'pengguna_sarana_id_pengguna_sarana');
    }
}
