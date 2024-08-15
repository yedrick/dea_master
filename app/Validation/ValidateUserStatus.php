<?php

namespace App\Validation;

use Illuminate\Validation\Validator;

class ValidateUserStatus {

    public function __invoke(Validator $validator){
        $data= $validator->getData();
        if (isset($data['state_id']) && $data['state_id'] == 1) {
            $validator->errors()->add('state_id', 'No puede ser añadido.');
        }
    }
}
