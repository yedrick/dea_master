<?php

namespace App\Services;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FormRequestService {

    protected $model;
    protected $formRequest;
    protected $data;

    // funcion para verificar si el modelo tiene un form request o no
    public function hasFormRequest() {
        $formRequest = $this->model::$formCreateRequest;
        if(class_exists($formRequest)) {
            $this->formRequest = new $formRequest();
            return true;
        }
        Log::info('no hasFormRequest');
        return false;
    }

    public function validate($model, $data) {
        $this->model = $model;
        $this->data = $data;
        if($this->hasFormRequest()) {
            $authorize = $this->formRequest->authorize();
            $this->validateAuthorize($authorize);
            $rules=  $this->formRequest->rules();
            $messages= $this->formRequest->messages();
            $attributes= $this->formRequest->attributes();
            $afters= $this->formRequest->aftersArray();
            return $this->initValidator($data, $rules, $messages, $attributes, $afters);
        }
    }

    protected function validateAuthorize($authorize) {
        if(!$authorize) {
            throw new AuthorizationException();
        }
    }

    public function initValidator($data, $rules, $messages, $attributes, $afters) {
        $validator = Validator::make($data, $rules, $messages);
        $validator->setAttributeNames($attributes);
        if(count($afters) > 0) {
            foreach($afters as $after) {
                $validator->after($after);
            }
        }
        if($validator->fails()) {
            return [
                'status' => false,
                'errors' => $validator->errors()
            ];
        }
        Log::info('validator success');
        return [
            'status' => true,
            'errors' => []
        ];
    }



}
