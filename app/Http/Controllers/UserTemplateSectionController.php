<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserTemplateSectionResource;
use App\Models\UserTemplateSection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Throwable;

class UserTemplateSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            $userTemplateSection = UserTemplateSection::with([
                'userTemplate',
                'userTemplate.template',
                'templateSection',
                'userTemplateValues',
                'userTemplateValues.templateValue',
            ])->findOrFail($id);
            return UserTemplateSectionResource::make($userTemplateSection);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User template section not found'], 404);
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
            $userTemplateSection = UserTemplateSection::findOrFail($id);
            $userTemplateSection->delete();
            return response()->json([], 204);
            return response()->json(['message' => 'User template not found'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
