<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    return response()->json(['message' => 'Hello World!']);
});

Route::group(['prefix' => 'vaccine'], function () {
    Route::get('/cat', function (Request $request) {
        return response()->json([
            [
                'name' => 'Vacina polivalente (V4 ou V5)',
                'description' => 'A versão V4 protege o gato contra a panleucopenia, a calicivirose, a rinotraqueíte e contra a clamidiose. Já a V5 é a mais completa, protegendo de todas as doenças que V4 protege mais a leucemia felina. Vacina com reforço anual.'
            ],
            [
                'name' => 'Vacina antirrábica',
                'description' => 'Imuniza seu gato contra a raiva. Vacina com reforço anual.'
            ]
        ]);
    });

    Route::get('/dog', function (Request $request) {
        return response()->json([
            [
                'name' => 'Vacina antirrábica',
                'description' => 'Uma das principais vacinas de cachorros, ela imuniza o pet contra a raiva canina. Vacina com reforço anual.',
                'validity' => '',
            ],
            [
                'name' => 'Vacina múltipla ou polivalente (V8 e V10)',
                'description' => 'Imuniza o pet contra doenças de origem viral e bacteriana. São elas: cinomose, parvovirose, coronavirose, hepatite infecciosa canina, adenovirose, parainfluenza e até alguns tipos de leptospirose. Vacina com reforço anual.',
                'validity' => '',
            ],
            [
                'name' => 'Vacina contra a giardíase',
                'description' => 'É considerada uma zoonose (doença transmitida entre animais e pessoas), um protozoário que é contraído principalmente em praias e parques por modo fecal-oral. Vacina com reforço anual.',
                'validity' => '',
            ],
            [
                'name' => 'Vacina contra a gripe canina',
                'description' => 'Também conhecida como “tosse dos canis” ou traqueobronquite infecciosa canina (TIC). Vacina com reforço anual.',
                'validity' => '',
            ]
        ]);
    });
});
