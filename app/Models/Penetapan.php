<?php

namespace App\Models;

use App\Models\FakultasPenetapan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penetapan extends Model
{
    protected $guarded = ['id'];
    
    protected static function booted()
    {
        static::created(function ($penetapan) {
            $fakultasList = Fakultas::all();
            foreach ($fakultasList as $fakultas) {
                FakultasPenetapan::create([
                    'penetapan_id' => $penetapan->id,
                    'fakultas_id' => $fakultas->id,
                ]);
            }
        });
    }
    
    public function fakultasPenetapans(): HasMany
    {
        return $this->hasMany(FakultasPenetapan::class);
    }
}
