<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori'];
    public $timestamps = true;

    public function perhitunganSampah() { return $this->hasMany(PerhitunganSampah::class, 'kategori_id_kategori'); }
    

}
