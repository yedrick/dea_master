<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Services\CrudNodeService;
use App\Services\FieldOptionService;
use App\Services\FieldService;
use App\Services\FormRequestService;
use App\Services\NodeService;
use App\Services\RulesValidationService;
use App\Services\TypeValidation;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MasterController extends Controller {
    //
    protected $prev;
    protected $node;
    protected $model;
    protected $nodeService;
    protected $typeValidation;


    public function __construct(TypeValidation $typeValidation) {
        // $this->middleware('auth');
        $this->prev = url()->previous();
        $this->typeValidation = $typeValidation;
    }

    // listado de un datos
    public function modelList($nodeName) {
        $node = Node::where('name', $nodeName)->first();
        if(!$node) return abort(404);
        if(!class_exists($node->model)) return abort(404);
        $model = $node->model;
        if(!app($model)) return abort(404);
        $nodeService = new NodeService($model);
        $fieldService = new FieldService($node);
        $fields = $fieldService->getFieldShowModel();
        $data=$nodeService->get(request());

        Log::info('data');
        Log::info(json_decode($data));
        Log::info('fields');
        Log::info(json_decode($fields));
        // return response()->json($data);
    }
    //obtener un dato
    public function modelCreate($nodeName) {
        $node = Node::where('name', $nodeName)->first();
        if(!$node) return abort(404);
        $fieldService = new FieldService($node);
        $fields = $fieldService->getFieldShow();
        $fieldOptionService = new FieldOptionService($node);
        $options = $fieldOptionService->getFieldOption($fields);
        Log::info('fields');
        Log::info(json_decode($fields));
        Log::info('options');
        Log::info(json_decode($options));
        // $options = $fieldService->getField();
        // return response()->json($data);
    }

    // guardar un datos
    public function store(Request $request, $nodeName) {
        \Log::info('store');
        $node = Node::where('name', $nodeName)->first();
        if(!$node) return abort(404);
        if(!class_exists($node->model)) return abort(404);
        $model = new $node->model;
        $validationResult=$this->typeValidation->hasTypeValidation($model,'created',$request);
        if(!$validationResult['status']){
            return redirect()->back()->withErrors($validationResult)->withInput();
        }





    }
}
