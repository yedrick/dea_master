<?php

namespace App\Services;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class RulesValidationService {
    protected $validationFactory;

    public function __construct(ValidationFactory $validationFactory)
    {
        $this->validationFactory = $validationFactory;
    }

    public function validate($modelClass, $data, $action = 'create') {
        $rulesProperty = "rules_{$action}";

        if (!property_exists($modelClass, $rulesProperty)) {
            throw new \InvalidArgumentException("Rules for '{$action}' action not defined in model");
        }

        $rules = $modelClass::$$rulesProperty;
        \Log::info('Rules: '.json_encode($rules));

        $validator = $this->validationFactory->make($data, $rules);

        if ($validator->fails()) {
            \Log::info('Errors: '.json_encode($validator->errors()));
            return [
                'status' => false,
                'errors' => $validator->errors()
            ];
        }

        return ['status' => true, 'data' => $validator->validated()];
    }

    public function validateCreate($modelClass, $data)
    {
        return $this->validate($modelClass, $data, 'create');
    }

    public function validateEdit($modelClass, $data)
    {
        return $this->validate($modelClass, $data, 'edit');
    }

    public function validateRead($modelClass, $data)
    {
        return $this->validate($modelClass, $data, 'read');
    }

    public function validateRemove($modelClass, $data)
    {
        return $this->validate($modelClass, $data, 'remove');
    }
}
