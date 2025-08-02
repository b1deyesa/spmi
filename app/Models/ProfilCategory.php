<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProfilCategory extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    
    public function profils(): HasMany
    {
        return $this->hasMany(Profil::class);
    }
}
