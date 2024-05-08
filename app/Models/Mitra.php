<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $table = 'mitras';
    protected $primaryKey = 'id_mitra';
    protected $fillable = ['nama_admin', 'no_hp'];
    public $timestamps = true;

    public function sarana() { return $this->hasMany(Sarana::class, 'mitra_id_mitra'); }
    
}
