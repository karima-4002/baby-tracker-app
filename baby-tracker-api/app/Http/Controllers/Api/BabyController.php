<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Baby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BabyController extends Controller
{
    public function index(Request $request)
    {
        $babies = $request->user()->babies()->with('vaccinations')->get();
        
        return response()->json([
            'success' => true,
            'data' => $babies
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date|before_or_equal:today',
            'gender' => 'required|in:garcon,fille',
            'birth_weight' => 'nullable|numeric|min:0',
            'birth_height' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $baby = $request->user()->babies()->create($request->all());

        // Créer les vaccinations par défaut
        $this->createDefaultVaccinations($baby);

        return response()->json([
            'success' => true,
            'data' => $baby->load('vaccinations'),
            'message' => 'Bébé ajouté avec succès'
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $baby = $request->user()->babies()->with('vaccinations', 'growthRecords')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $baby
        ]);
    }

    public function update(Request $request, $id)
    {
        $baby = $request->user()->babies()->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'birth_date' => 'sometimes|date|before_or_equal:today',
            'gender' => 'sometimes|in:garcon,fille',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $baby->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $baby
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $baby = $request->user()->babies()->findOrFail($id);
        $baby->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bébé supprimé'
        ]);
    }

    private function createDefaultVaccinations($baby)
    {
        $vaccinations = [
            ['age' => 2, 'name' => 'DTCa-Hib-HepB-VPI (1ère dose)'],
            ['age' => 2, 'name' => 'Pneumocoque (1ère dose)'],
            ['age' => 4, 'name' => 'DTCa-Hib-HepB-VPI (2ème dose)'],
            ['age' => 4, 'name' => 'Pneumocoque (2ème dose)'],
            ['age' => 11, 'name' => 'DTCa-Hib-HepB-VPI (3ème dose)'],
            ['age' => 11, 'name' => 'Méningocoque C'],
            ['age' => 12, 'name' => 'ROR (1ère dose)'],
            ['age' => 16, 'name' => 'ROR (2ème dose)'],
        ];

        foreach ($vaccinations as $vacc) {
            $baby->vaccinations()->create([
                'vaccine_name' => $vacc['name'],
                'scheduled_date' => now()->parse($baby->birth_date)->addMonths($vacc['age']),
                'status' => 'pending'
            ]);
        }
    }
}
