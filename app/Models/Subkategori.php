<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkategori extends Model
{
    use HasFactory;
    protected $table = 'subkategoris';
    protected $primaryKey = 'id_subkategori';
    protected $fillable = ['nama_subkategori','kategori_id_kategori'];
    public $timestamps = true;


}
