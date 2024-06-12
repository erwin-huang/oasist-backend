<?php

namespace App\Http\Controllers;

use App\Http\Resources\TemplateResource;
use App\Http\Resources\UserTemplateResource;
use App\Models\UserTemplate;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Throwable;

class UserTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ?? 10;
        return UserTemplateResource::collection(UserTemplate::with("template")->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $userTemplate = UserTemplate::with(['template', 'userTemplateSections', 'userTemplateSections.userTemplateValues'])->findOrFail($id);
            return TemplateResource::make($userTemplate);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User template not found'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $userTemplate = UserTemplate::findOrFail($id);
            $userTemplate->delete();
            return response()->json([], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User template not found'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
