<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FakultasProfil extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    
    public function fakultas(): BelongsTo
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }
    
    public function profil(): BelongsTo
    {
        return $this->belongsTo(Profil::class, 'profil_id');
    }
}
