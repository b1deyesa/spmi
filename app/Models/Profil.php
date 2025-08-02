<?php

namespace App\Models;

use App\Models\Fakultas;
use App\Models\FakultasProfil;
use App\Models\ProfilCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profil extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    
    protected static function booted()
    {
        static::created(function ($profil) {
            $fakultas = Fakultas::all();
            foreach ($fakultas as $f) {
                FakultasProfil::create([
                    'fakultas_id' => $f->id,
                    'profil_id' => $profil->id,
                ]);
            }
        });
    }
    
    public function profilCategory(): BelongsTo
    {
        return $this->belongsTo(ProfilCategory::class, 'profil_category_id');
    }
}
