<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarana extends Model
{
    use HasFactory;

    protected $table = 'saranas';
    protected $primaryKey = 'id_sarana';
    protected $fillable = ['nama_sarana', 'alamat_sarana', 'jenis_sarana', 'mitra_id_mitra'];
    public $timestamps = true;

    public function mitra() { return $this->belongsTo(Mitra::class, 'mitra_id_mitra'); }
}
