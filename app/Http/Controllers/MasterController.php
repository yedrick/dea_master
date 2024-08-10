<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Services\CrudNodeService;
use App\Services\NodeService;
use Illuminate\Http\Request;

class MasterController extends Controller {
    //
    protected $prev;
    protected $node;
    protected $model;
    protected $nodeService;

    public function __construct() {
        // $this->middleware('auth');
        $this->prev = url()->previous();
        // $this->nodeService = $nodeService;
    }

    public function modelList($nodeName) {
        $node = Node::where('name', $nodeName)->first();
        $model = $node->model;
        $nodeService = new NodeService($model);
        $data=$nodeService->get(request());
        return response()->json($data);


    }
}
