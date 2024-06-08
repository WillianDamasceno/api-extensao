<?php

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::get('/', function () {
    return response()->json(['message' => 'Hello World!']);
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('/register', function () {
        $emailValidator = Validator::make(request()->all(), [
            'email' => 'required|string|max:255|unique:users',
        ]);

        if ($emailValidator->fails()) {
            return response()->json(['data' => 'unique'], 200);
        }

        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true], 422);
        }

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
        ]);

        return response()->json(['data' => $user->id]);
    });

    Route::get('/login', function () {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true], 422);
        }

        $user = User::where('email', request('email'))->first();

        if (!$user) {
            return response()->json(['error' => true], 404);
        }

        if (!bcrypt(request('password')) === $user->password) {
            return response()->json(['error' => true], 401);
        }

        return response()->json(['data' => $user->id]);
    });

    Route::get('/update', function () {
        $user = User::find((int) request('id'));

        if (!$user) {
            return response()->json(['error' => true], 404);
        }

        $validator = Validator::make(request()->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'password' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true], 422);
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
        ]);
    });

    Route::get('/delete', function () {
        User::where('id', (int) request('id'))->delete();
        return response()->json(['data' => true]);
    });
});

Route::group(['prefix' => 'pet'], function () {
    Route::get('create', function () {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string',
            'born' => 'required|string',
            'type' => 'required|string',
            'user_id' => 'required|integer',
            'vaccines' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true]);
        }

        $pet = Pet::create([
            'name' => request('name'),
            'born' => request('born'),
            'type' => request('type'),
            'vaccines' => request('vaccines'),
            'user_id' => request('user_id'),
        ]);

        return response()->json(['data' => $pet->id]);
    });

    Route::get('/update', function () {
        $pet = Pet::find((int) request('id'));

        if (!$pet) {
            return response()->json(['error' => true], 404);
        }

        $validator = Validator::make(request()->all(), [
            'name' => 'nullable|string',
            'born' => 'nullable|string',
            'type' => 'nullable|string',
            'vaccines' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true], 422);
        }

        if (request('name')) {
            $pet->name = request('name');
        }

        if (request('born')) {
            $pet->born = request('born');
        }

        if (request('type')) {
            $pet->type = request('type');
        }

        if (request('vaccines')) {
            $pet->vaccines = request('vaccines');
        }

        $pet->save();

        return response()->json(['data' => $pet->id]);
    });

    Route::get('delete', function () {
        Pet::where('id', (int) request('id'))->delete();
        return response()->json(['data' => true]);
    });

    Route::get('get', function () {
        $pet = Pet::find((int) request('id'));

        return response()->json([
            'name' => $pet->name,
            'born' => $pet->born,
            'type' => $pet->type,
            'vaccines' => $pet->vaccines,
            'user_id' => $pet->user_id,
        ]);
    });

    Route::get('/get-user-pets', function () {
        return response()->json(
            User::find((int) request('user_id'))
                ->pets()
                ->orderBy('id', 'desc')
                ->get()
        );
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

    Route::get('/dog', function () {
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
