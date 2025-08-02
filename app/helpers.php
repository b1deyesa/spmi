<?php

use Illuminate\Support\Facades\URL;

function route_f($name, $parameters = [], $absolute = true) {
    if (!is_array($parameters)) {
        $parameters = [$parameters];
    }

    if (!isset($parameters['fakultas'])) {
        $fakultas = request()->route('fakultas');

        if ($fakultas instanceof \App\Models\Fakultas) {
            $parameters['fakultas'] = $fakultas->getRouteKey();
        } elseif ($fakultas) {
            $parameters['fakultas'] = $fakultas;
        } else {
            $parameters['fakultas'] = session('fakultas_id');
        }
    }

    return route($name, $parameters, $absolute);
}