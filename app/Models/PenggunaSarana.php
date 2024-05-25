<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaSarana extends Model
{
    use HasFactory;

    protected $table = 'pengguna_saranas';
    protected $primaryKey = 'id_pengguna_sarana';
    protected $fillable = ['nama_pengguna', 'no_hp','id_akun'];
    public $timestamps = true;



    public function user()
    {
        return $this->belongsTo(User::class, 'id_akun');
    }

}
