<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class TypeValidation{
    protected $type=[
        'created'=>'formCreateRequest',
        'updated'=>'formUpdateRequest',
    ];
    protected $formRequest ;
    protected $rulesValidation;

    public function __construct(FormRequestService $formRequestService, RulesValidationService $rulesValidationService){
        $this->formRequest = $formRequestService;
        $this->rulesValidation = $rulesValidationService;
    }

    public function hasTypeValidation($model,$type,$request){
        $type = $this->type[$type];
        if (property_exists($model, $type)) {
            Log::info('formRequest');
            return $this->formRequest->validate($model, $request->all());
        } else {
            Log::info('rulesValidation');
            return $this->rulesValidation->validate($model, $request->all(), 'create');
        }
    }
}
