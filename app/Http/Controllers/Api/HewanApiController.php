<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hewan;

class HewanApiController extends Controller
{
    public function apiIndex() {
        return response()->json([
            "data" => Hewan::whereNull('deleted_at')->get()
        ]);
    }

    public function apiStore(Request $request) {
        $data = Hewan::create($request->all());
        return response()->json([
            "success" => true,
            "data" => $data
        ], 201);
    }

    public function apiUpdate(Request $request, $id) {
        $data = Hewan::findOrFail($id);
        $data->update($request->all());
        return response()->json(["success" => true]);
    }

    public function apiDelete($id) {
        $data = Hewan::findOrFail($id);
        $data->delete();
        return response()->json(["success" => true]);
    }
}
