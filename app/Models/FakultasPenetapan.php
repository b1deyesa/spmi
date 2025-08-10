<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FakultasPenetapan extends Model
{
    protected $guarded = ['id'];
    
    public function fakultas(): BelongsTo
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }
    
    public function penetapan(): BelongsTo
    {
        return $this->belongsTo(Penetapan::class, 'penetapan_id');
    }
}
