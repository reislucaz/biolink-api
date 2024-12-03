<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ReceptorMedicalInfo;
use App\Models\DonorMedicalInfo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'type' => ['required', 'in:RECEPTOR,DOADOR,ADMIN'],
            'birth_date' => ['required', 'date'],
            'cpf' => ['required', 'string', 'max:14', 'unique:users,cpf'],
            'rg' => ['nullable', 'string', 'max:20'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'gender' => ['required', 'in:MASC,FEM'],
            'address' => ['nullable', 'string', 'max:255'],
            'district' => ['nullable', 'string', 'max:100'], // Bairro
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'zip_code' => ['nullable', 'string', 'max:10'], // CEP
            'phone' => ['nullable', 'string', 'max:15'],
        ]);

        return DB::transaction(function () use ($request) {
            // Criação do usuário
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => $request->type,
                'birth_date' => $request->birth_date,
                'cpf' => $request->cpf,
                'rg' => $request->rg,
                'nationality' => $request->nationality,
                'gender' => $request->gender,
                'address' => $request->address,
                'district' => $request->district,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'phone' => $request->phone,
            ]);

            // Lógica adicional para tipos de usuário
            if ($user->type === 'RECEPTOR') {
                $request->validate([
                    'blood_type' => ['required', 'string', 'max:3'],
                    'rh_factor' => ['required', 'string', 'max:3'],
                    'health_problems' => ['nullable', 'string'],
                    'medical_history' => ['nullable', 'string'],
                    'transplant_history' => ['nullable', 'string'],
                    'required_organ' => ['required', 'string', 'max:100'],
                ]);

            ReceptorMedicalInfo::create([
                'user_id' => $user->id,
                'blood_type' => $request->blood_type,
                'rh_factor' => $request->rh_factor,
                'health_problems' => $request->health_problems,
                'medical_history' => $request->medical_history,
                'transplant_history' => $request->transplant_history,
                'required_organ' => $request->required_organ,
            ]);
        } elseif ($user->type === 'DOADOR') {
            $request->validate([
                'organs_to_donate' => ['required', 'array'],
                'blood_type' => ['required', 'string', 'max:3'],
                'rh_factor' => ['required', 'string', 'max:3'],
                'preexisting_conditions' => ['nullable', 'string'],
                'allergies' => ['nullable', 'string'],
                'continuous_medication' => ['nullable', 'string'],
                'alcohol_consumer' => ['required', 'boolean'],
                'smoker' => ['required', 'boolean'],
                'family_history' => ['nullable', 'string'],
            ]);

                DonorMedicalInfo::create([
                    'user_id' => $user->id,
                    'organs_to_donate' => json_encode($request->organs_to_donate),
                    'blood_type' => $request->blood_type,
                    'rh_factor' => $request->rh_factor,
                    'preexisting_conditions' => $request->preexisting_conditions,
                    'allergies' => $request->allergies,
                    'continuous_medication' => $request->continuous_medication,
                    'alcohol_consumer' => $request->alcohol_consumer,
                    'smoker' => $request->smoker,
                    'family_history' => $request->family_history,
                ]);
            }

            return response()->json([
                'message' => 'Usuário cadastrado com sucesso.',
                'user' => $user,
            ], 201);
        });
    }
}
