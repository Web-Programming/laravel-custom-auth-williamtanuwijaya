<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = "mahasiswas";
    protected $fillable = ['npm', 'nama', 'tempat_lahir', 'tanggal_lahir'];
    protected $guarded = ['', ''];

    public function prodi()
    {
        return $this->belongsTo('App\Models\Prodi');
    }
}
