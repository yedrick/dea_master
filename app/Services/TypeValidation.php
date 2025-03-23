<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class TypeValidation
{
    protected $type = [
        'created' => 'formCreateRequest',
        'updated' => 'formUpdateRequest',
    ];
    protected $formRequest;
    protected $rulesValidation;

    public function __construct(FormRequestService $formRequestService, RulesValidationService $rulesValidationService)
    {
        $this->formRequest = $formRequestService;
        $this->rulesValidation = $rulesValidationService;
    }

    public function hasTypeValidation($model, $type, $request)
    {
        $type_property = $this->type[$type];
        if (property_exists($model, $type_property)) {
            Log::info('formRequest');
            return $this->formRequest->validate($model, $request->all(), $type_property);
        } else if (property_exists($model, 'rules_' . $type)) {
            Log::info('rulesValidation');
            return $this->rulesValidation->validate($model, $request->all(), $type);
        } else {
            Log::info('Nose encontro el tipo de validacion');
            return [
                'status' => false,
                'is_validate' => false,
                'type_property' => $type_property,
            ];
        }
    }
}
