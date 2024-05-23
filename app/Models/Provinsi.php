<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinsis';
    protected $primaryKey = 'id_provinsi';
    protected $fillable = ['nama_provinsi'];
    public $timestamps = true;

    public function sarana()
    {
        return $this->hasMany(Sarana::class, 'provinsi_id_provinsi');
    }
}
