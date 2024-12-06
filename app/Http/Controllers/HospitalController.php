<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $hospitals = Hospital::all();
        return response()->json($hospitals);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cnpj' => 'required|string|size:14|unique:hospitals,cnpj',
            'address' => 'required|string|max:255',
            'cep' => 'required|string|max:10',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:hospitals,email',
            'status' => 'boolean',
        ]);

        $hospital = Hospital::query()->create($request->all());
        return response()->json(['message' => 'Hospital criado com sucesso.', 'hospital' => $hospital], 201);
    }

    public function show(Hospital $hospital): \Illuminate\Http\JsonResponse
    {
        return response()->json($hospital);
    }

    public function update(Request $request, Hospital $hospital): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'string|max:255',
            'cnpj' => 'string|size:14|unique:hospitals,cnpj,' . $hospital->id,
            'address' => 'string|max:255',
            'cep' => 'string|max:10',
            'phone' => 'string|max:15',
            'email' => 'email|max:255|unique:hospitals,email,' . $hospital->id,
            'status' => 'boolean',
        ]);

        $hospital->update($request->all());
        return response()->json(['message' => 'Hospital atualizado com sucesso.', 'hospital' => $hospital]);
    }

    public function destroy(Hospital $hospital): \Illuminate\Http\JsonResponse
    {
        $hospital->delete();
        return response()->json(['message' => 'Hospital excluído com sucesso.']);
    }
}
