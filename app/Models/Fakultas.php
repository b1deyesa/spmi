<?php

namespace App\Models;

use App\Models\User;
use App\Models\Profil;
use App\Models\Kebijakan;
use App\Models\ProgramStudi;
use App\Models\FakultasProfil;
use App\Models\FakultasKebijakan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fakultas extends Model
{
    /** @use HasFactory<\Database\Factories\FakultasFactory> */
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;
    
    protected static function booted()
    {
        static::created(function ($fakultas) {
            $kebijakanList = Kebijakan::all();
            foreach ($kebijakanList as $kebijakan) {
                FakultasKebijakan::create([
                    'fakultas_id' => $fakultas->id,
                    'kebijakan_id' => $kebijakan->id,
                ]);
            }

            $profils = Profil::all();
            foreach ($profils as $profil) {
                FakultasProfil::create([
                    'fakultas_id' => $fakultas->id,
                    'profil_id' => $profil->id,
                ]);
            }
        });
    }
    
    public function programStudis(): HasMany
    {
        return $this->hasMany(ProgramStudi::class);
    }
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    
    public function fakultasKebijakans(): HasMany
    {
        return $this->hasMany(FakultasKebijakan::class);
    }
    
    public function fakultasProfils(): HasMany
    {
        return $this->hasMany(FakultasProfil::class);
    }
}