<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramStudi extends Model
{
    /** @use HasFactory<\Database\Factories\ProgramStudiFactory> */
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;
    
    public function fakultas(): BelongsTo
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }
    
    public function akreditasis(): BelongsToMany
    {
        return $this->belongsToMany(Akreditasi::class)->withPivot('tanggal_berlaku', 'tanggal_berakhir', 'nomor_sk', 'is_internasional');
    }
    
    public function dosens(): HasMany
    {
        return $this->hasMany(Dosen::class);
    }
    
    public function mahasiswas(): HasMany
    {
        return $this->hasMany(Mahasiswa::class);
    }
    
    public function jenjang(): BelongsTo
    {
        return $this->belongsTo(Jenjang::class, 'jenjang_id');
    }
}
