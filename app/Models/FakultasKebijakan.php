<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FakultasKebijakan extends Model
{
    protected $guarded = ['id'];
    
    public function fakultas(): BelongsTo
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }
    
    public function kebijakan(): BelongsTo
    {
        return $this->belongsTo(Kebijakan::class, 'kebijakan_id');
    }
}
