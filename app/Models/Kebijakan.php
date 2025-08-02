<?php

namespace App\Models;

use App\Models\Fakultas;
use App\Models\FakultasKebijakan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kebijakan extends Model
{
    /** @use HasFactory<\Database\Factories\KebijakanFactory> */
    use HasFactory;
    protected $guarded = ['id'];
    
    protected static function booted()
    {
        static::created(function ($kebijakan) {
            $fakultasList = Fakultas::all();

            foreach ($fakultasList as $fakultas) {
                FakultasKebijakan::create([
                    'kebijakan_id' => $kebijakan->id,
                    'fakultas_id' => $fakultas->id,
                ]);
            }
        });
    }
    
    public function fakultasKebijakans(): HasMany
    {
        return $this->hasMany(FakultasKebijakan::class);
    }
}
