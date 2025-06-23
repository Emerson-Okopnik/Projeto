<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PetResource;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $query = Pet::with('client');

        if ($request->has('client_id') && $request->client_id) {
            $query->where('client_id', $request->client_id);
        }

        if ($request->has('species') && $request->species) {
            $query->where('species', 'ILIKE', "%{$request->species}%");
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ILIKE', "%{$search}%")
                  ->orWhere('species', 'ILIKE', "%{$search}%")
                  ->orWhere('breed', 'ILIKE', "%{$search}%");
            });
        }

        $pets = $query->orderBy('created_at', 'desc')
                  ->paginate($request->get('per_page', 15));

        return PetResource::collection($pets);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:100',
            'breed' => 'nullable|string|max:100',
            'gender' => 'required|in:male,female',
            'birth_date' => 'nullable|date',
            'weight' => 'nullable|numeric|min:0',
            'color' => 'nullable|string|max:100',
            'microchip' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pet = Pet::create($request->all());
        $pet->load('client');

        return new PetResource($pet);
    }

    public function show(Pet $pet)
    {
        $pet->load('client', 'appointments.veterinarian', 'medicalRecords');
        return new PetResource($pet);
    }

    public function update(Request $request, Pet $pet)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'nullable|exists:clients,id',
            'name' => 'nullable|string|max:255',
            'species' => 'nullable|string|max:100',
            'breed' => 'nullable|string|max:100',
            'gender' => 'nullable|in:male,female',
            'birth_date' => 'nullable|date',
            'weight' => 'nullable|numeric|min:0',
            'color' => 'nullable|string|max:100',
            'microchip' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pet->update($request->all());
        $pet->load('client');

        return new PetResource($pet);
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();
        return response()->json(['message' => 'Pet deleted successfully']);
    }
}
