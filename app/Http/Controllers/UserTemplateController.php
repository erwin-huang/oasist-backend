<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserTemplateResource;
use App\Models\TemplateSection;
use App\Models\TemplateValue;
use App\Models\UserTemplate;
use App\Models\UserTemplateSection;
use App\Models\UserTemplateValue;
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
        try {
            $perPage = $request->per_page ?? 10;
            $userTemplates = UserTemplate::with("template")->where("user_id", $request->user()->id)->paginate($perPage);

            return UserTemplateResource::collection($userTemplates);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $createUserTemplateData = $request->validate([
            'name' => 'required|string',
            'template_id' => 'required|string|exists:templates,id',
        ]);

        try {
            $userTemplate = UserTemplate::create([
                'template_id' => $createUserTemplateData['template_id'],
                'user_id' => $request->user()->id,
                'name' => $createUserTemplateData['name'],
            ]);

            $templateSections = TemplateSection::where('template_id', $userTemplate->template_id)->get();
            foreach ($templateSections as $templateSection) {
                $userTemplateSection = UserTemplateSection::create([
                    'template_section_id' => $templateSection->id,
                    'user_template_id' => $userTemplate->id,
                    'order' => $templateSection->order, // Assuming 'order' exists in TemplateSection
                ]);

                $templateValues = TemplateValue::where('template_section_id', $templateSection->id)->get();

                foreach ($templateValues as $templateValue) {
                    UserTemplateValue::create([
                        'template_value_id' => $templateValue->id,
                        'user_template_section_id' => $userTemplateSection->id,
                        'value' => $templateValue->value,
                    ]);
                }
            }
            return response()->json(UserTemplateResource::make($userTemplate), 201);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $userTemplate = UserTemplate::with([
                'template',
                'userTemplateSections',
                'userTemplateSections.templateSection',
                'userTemplateSections.userTemplateValues',
                'userTemplateSections.userTemplateValues.templateValue',
            ])->findOrFail($id);
            return UserTemplateResource::make($userTemplate);
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
        $updateUserTemplateData = $request->validate([
            'name' => 'required|string',
            'published_at' => 'date|nullable|date_format:Y-m-d H:i:s|after_or_equal:now - 20 minute',
        ]);

        try {
            $userTemplate = UserTemplate::findOrFail($id);
            $userTemplate->name = $updateUserTemplateData['name'];
            if (array_key_exists('published_at', $updateUserTemplateData)) {
                $userTemplate->published_at = $updateUserTemplateData['published_at'];
            }
            $userTemplate->save();
            return response()->json(UserTemplateResource::make($userTemplate), 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User template not found'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
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
