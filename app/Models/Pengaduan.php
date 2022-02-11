<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_kejadian',
        'nik',
        'isi_laporan',
        'foto',
    ];

    public function tanggapan()
    {
        return $this->belongsTo(Tanggapan::class, 'id', 'id_pengaduan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nik', 'nik');
    }
}
