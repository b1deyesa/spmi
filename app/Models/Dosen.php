<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dosen extends Model
{
    /** @use HasFactory<\Database\Factories\DosenFactory> */
    use HasFactory;
    public $timestamps = false;
    
    public function programStudi(): BelongsTo
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }
    
    public function bimbingans(): HasMany
    {
        return $this->hasHash(Bimbingan::class);
    }
}
