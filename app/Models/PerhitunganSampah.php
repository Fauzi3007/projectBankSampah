<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerhitunganSampah extends Model
{
    use HasFactory;

    protected $table = 'perhitungan_sampahs';
    protected $primaryKey = 'id_perhitungan_sampah';
    protected $fillable = ['tanggal', 'kategori_id_kategori', 'jumlah_sampah', 'sarana_id_sarana'];
    public $timestamps = true;

    public function kategori() { return $this->belongsTo(Kategori::class, 'kategori_id_kategori'); }

    public function sarana() { return $this->belongsTo(Sarana::class, 'sarana_id_sarana'); }
}
