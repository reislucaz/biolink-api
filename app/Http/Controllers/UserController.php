<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * List all users with optional filtering by type.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request): \Illuminate\Http\JsonResponse
    {
        $type = $request->input('type'); // Filtrar por tipo, se fornecido
        $per_page = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $query = User::query();

        if ($type) {
            $query->where('type', $type);
        }

        $users = $query->paginate($per_page, ['*'], 'page', $page);

        return response()->json($users);
    }

    /**
     * Get user by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById(int $id): \Illuminate\Http\JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found.',
            ], 404);
        }

        return response()->json($user);
    }
}
