<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerhitunganSampah extends Model
{
    use HasFactory;

    protected $table = 'perhitungan_sampahs';
    protected $primaryKey = 'id_perhitungan_sampah';
    protected $fillable = ['tanggal', 'kategori_id_kategori', 'subkategori_id_subkategori','jumlah_sampah', 'sarana_id_sarana', 'user_id_user'];
    public $timestamps = true;

    public function kategori() { return $this->belongsTo(Kategori::class, 'kategori_id_kategori'); }

    public function subkategori() { return $this->belongsTo(Subkategori::class, 'subkategori_id_subkategori'); }

    public function sarana() { return $this->belongsTo(Sarana::class, 'sarana_id_sarana'); }

    public function user() { return $this->belongsTo(User::class, 'user_id_user'); }

    public function provinsi() { return $this->belongsTo(Provinsi::class, 'provinsi_id_provinsi'); }
}
