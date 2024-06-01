<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::get('/', function (Request $request) {
    return response()->json(['message' => 'Hello World!']);
});
Route::group(['prefix' => 'auth'], function () {
    Route::get('/register', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['data' => $user->id]);
    });

    Route::get('/login', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (!bcrypt($request->password) === $user->password) {
            return response()->json(['message' => 'Invalid password'], 401);
        }

        return response()->json(['data' => $user->id]);
    });

    Route::get('/update', function () {
        $user = User::find((int) request('id'));

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validator = Validator::make(request()->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (request('name')) {
            $user->name = request('name');
        }

        if (request('email')) {
            $user->email = request('email');
        }

        if (request('password')) {
            $user->password = bcrypt(request('password'));
        }

        $user->save();

        return response()->json(['data' => $user->id]);
    });

    Route::get('/get', function () {
        $user = User::find((int) request('id'));

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        ]);
    });

    Route::get('/delete', function () {
        return response()->json(['data' => User::where('id', (int) request('id'))->delete()]);
    });
});

Route::group(['prefix' => 'vaccine'], function () {
    Route::get('/cat', function () {
        return response()->json([
            [
                'name' => 'Vacina polivalente (V4 ou V5)',
                'description' => 'A versão V4 protege o gato contra a panleucopenia, a calicivirose, a rinotraqueíte e contra a clamidiose. Já a V5 é a mais completa, protegendo de todas as doenças que V4 protege mais a leucemia felina. Vacina com reforço anual.',
                'validity' => '',
            ],
            [
                'name' => 'Vacina antirrábica',
                'description' => 'Imuniza seu gato contra a raiva. Vacina com reforço anual.',
                'validity' => '',
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
