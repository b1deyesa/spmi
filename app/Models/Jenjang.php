<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jenjang extends Model
{
    public $timestamps = false;
    
    public function mahasiswas(): HasMany
    {
        return $this->hasMany(Mahasiswa::class);
    }
    
    public function programStudis(): HasMany
    {
        return $this->hasMany(ProgramStudi::class);
    }
}
