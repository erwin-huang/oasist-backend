<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserTemplateSectionResource;
use App\Models\UserTemplateSection;
use App\Models\UserTemplateValue;
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
    public function show(Request $request, string $id)
    {
        try {
            $userTemplateSection = UserTemplateSection::with([
                'userTemplate',
                'userTemplate.template',
                'templateSection',
                'userTemplateValues',
                'userTemplateValues.templateValue',
            ])->findOrFail($id);

            if ($userTemplateSection->userTemplate->user_id !== $request->user()->id) {
                return response()->json(['message' => 'User does not have access to this user template section'], 403);
            }

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
        try {
            $userTemplateSection = UserTemplateSection::findOrFail($id);
            if ($userTemplateSection->userTemplate->user_id !== $request->user()->id) {
                return response()->json(['message' => 'User does not have access to this user template section'], 403);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User template section not found'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        $updateUserTemplateSectionData = $request->validate([
            'template_values' => 'required|array|min:1',
            'template_values.*.id' => "required|exists:user_template_values,id,user_template_section_id,$id",
            'template_values.*.value' => 'required|string',
        ]);

        try {
            foreach ($updateUserTemplateSectionData['template_values'] as $templateValue) {
                UserTemplateValue::where('user_template_section_id', $id)
                    ->where('id', $templateValue['id'])
                    ->update(['value' => $templateValue['value']]);
            }

            $userTemplateSectionUpdated = UserTemplateSection::with([
                'templateSection',
                'userTemplateValues.templateValue',
            ])->findOrFail($id);
            return UserTemplateSectionResource::make($userTemplateSectionUpdated);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User template section not found'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            $userTemplateSection = UserTemplateSection::findOrFail($id);
            if ($userTemplateSection->userTemplate->user_id !== $request->user()->id) {
                return response()->json(['message' => 'User does not have access to this user template section'], 403);
            }

            $userTemplateSection->delete();
            return response()->json([], 204);
            return response()->json(['message' => 'User template not found'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
