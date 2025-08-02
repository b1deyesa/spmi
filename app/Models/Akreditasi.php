<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Akreditasi extends Model
{
    public $timestamps = false;
    
    public function fakultases(): HasMany
    {
        return $this->hasMany(Fakultas::class);
    }
    
    public function programStudis(): BelongsToMany
    {
        return $this->belongsToMany(ProgramStudi::class)->withPivot('tanggal_berlaku', 'tanggal_berakhir', 'nomor_sk', 'is_internasional');
    }
}
