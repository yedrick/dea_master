<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Filter;
use App\Models\Node;
use App\Services\CrudNodeService;
use App\Services\FieldOptionService;
use App\Services\FieldService;
use App\Services\FiltersService;
use App\Services\FormRequestService;
use App\Services\NodeService;
use App\Services\ReportExcel;
use App\Services\RulesValidationService;
use App\Services\TypeValidation;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MasterController extends Controller
{
    //
    protected $prev;
    protected $node;
    protected $model;
    protected $nodeService;
    protected $typeValidation;
    protected $filter;


    public function __construct(TypeValidation $typeValidation, FiltersService $filtersService)
    {
        // $this->middleware('auth');
        $this->prev = url()->previous();
        $this->typeValidation = $typeValidation;
        $this->filter = $filtersService;
    }

    // listado de un datos
    public function modelList($nodeName)
    {
        $node = Node::where('name', $nodeName)->first();
        if (!$node) return abort(404);
        if (!class_exists($node->model)) return abort(404);
        $model = $node->model;
        if (!app($model)) return abort(404);
        $nodeService = new NodeService($model);
        $fieldService = new FieldService($node);
        $fields_active = $fieldService->getFieldShowModel();
        $fields = $fieldService->getFieldAll();
        $data = $nodeService->get(request(), $node);
        $filters = $this->filter->getFilter($node->id);
        // notify()->success('Welcome to Laravel Notify ⚡️', 'My custom title');
        return view('node.index', ['node' => $node, 'data' => $data, 'fields' => $fields, 'titles' => $fields_active, 'filters' => $filters]);
    }


    //obtener un dato
    public function modelCreate($nodeName)
    {
        $node = Node::where('name', $nodeName)->first();
        if (!$node) return abort(404);
        $fieldService = new FieldService($node);
        $fields = $fieldService->getFieldShow();
        $fieldOptionService = new FieldOptionService($node);
        $options = $fieldOptionService->getFieldOption($fields);
        $field_form = $fieldService->getFieldForm();
        return view('node.create', ['node' => $node, 'fields' => $fields, 'options' => $options, 'field_form' => $field_form]);
    }

    // actualizar un datos
    public function modelEdit($nodeName, $id)
    {
        $node = Node::where('name', $nodeName)->first();
        if (!$node) return abort(404);
        $fieldService = new FieldService($node);
        $fields = $fieldService->getFieldShow();
        $fieldOptionService = new FieldOptionService($node);
        $options = $fieldOptionService->getFieldOption($fields);
        $field_form = $fieldService->getFieldForm();
        $model = new $node->model;
        $model = $model->find($id);
        if (!$model) return abort(404);
        return view('node.edit', ['node' => $node, 'fields' => $fields, 'options' => $options, 'field_form' => $field_form, 'model' => $model]);
    }

    // guardar un datos
    public function store(Request $request, $nodeName)
    {
        $node = Node::where('name', $nodeName)->first();
        if (!$node) return abort(404);
        if (!class_exists($node->model)) return abort(404);
        $model = new $node->model;
        $validationResult = $this->typeValidation->hasTypeValidation($model, 'created', $request);
        if (isset($validationResult['is_validate']) && !$validationResult['is_validate']) {
            $type_property = $validationResult['type_property'];
            return view('errors.missing_validation', [
                'errorMessage' => 'Debe definir las reglas de validación para el tipo "' . $type_property . '" en el modelo. '
                    . 'Ninguna de las dos validaciones (formRequest o rulesValidation) está definida correctamente.'
            ]);
        }
        if (!$validationResult['status']) {
            if ($request->hasFile('image')) {
                $imagen = $request->file('image');
                $nombreArchivo = time() . '.' . $imagen->extension();
                $imagen->move(public_path('/temp'), $nombreArchivo);
                session()->flash('temp_image', [
                    'name' => $imagen->getClientOriginalName(),
                    'path' => asset('temp/' . $nombreArchivo)
                ]);
            }
            return redirect()->back()->withErrors($validationResult['errors'])->withInput();
        }
        $fieldService = new FieldService($node);
        $field_form = $fieldService->getFieldForm();
        foreach ($field_form as $key => $field) {
            $fieldName = $field->name;
            if ($field->type == 'file') {
                $file = $request->file($fieldName);
                if ($file) {
                    $fileName = uniqid() . '_' . $file->getClientOriginalName();
                    $file->storeAs('public/files', $fileName);
                    $model->{$fieldName} = $fileName;
                }
            } elseif ($field->type == 'image') {
                $file = $request->file($fieldName);
                if ($file) {
                    $fileName = uniqid() . '_' . $file->getClientOriginalName();
                    $destinationPath = public_path('images/' . $node->name);
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $file->move($destinationPath, $fileName);
                    $model->{$fieldName} = $fileName;
                    session()->forget('temp_image');
                } elseif ($request->has('temp_image_path')) {
                    $tempPath = $request->input('temp_' . $field->name . '_path');
                    $tempFileName = basename(parse_url($tempPath, PHP_URL_PATH));
                    if (file_exists(public_path('temp/' . $tempFileName))) {
                        $imageName = time() . '_' . $tempFileName;
                        \Illuminate\Support\Facades\File::move(
                            public_path('temp/' . $tempFileName),
                            public_path('images/' . $node->name . '/' . $imageName)
                        );
                        $model->{$fieldName} = $imageName;
                        session()->forget('temp_image');
                    }
                }
            } elseif ($field->type == 'password') {
                $model->$fieldName = bcrypt($request->$fieldName);
            } elseif ($field->type == 'checkbox') {
                $model->$fieldName = is_array($request->$fieldName) ? json_encode($request->$fieldName) : $request->$fieldName;
            } else {
                $model->$fieldName = $request->$fieldName;
            }
        }
        $model->save();

        return redirect()->route('model.list', ['nodeName' => $nodeName])->with('message_success', 'Registro creado correctamente');
    }

    public function update(Request $request, $nodeName, $id)
    {
        $node = Node::where('name', $nodeName)->first();
        if (!$node) return abort(404);
        if (!class_exists($node->model)) return abort(404);
        $model = new $node->model;
        $model = $model->find($id);
        if (!$model) return abort(404);
        $validationResult = $this->typeValidation->hasTypeValidation($model, 'updated', $request);
        if (isset($validationResult['is_validate']) && !$validationResult['is_validate']) {
            $type_property = $validationResult['type_property'];
            return view('errors.missing_validation', [
                'errorMessage' => 'Debe definir las reglas de validación para el tipo "' . $type_property . '" en el modelo. '
                    . 'Ninguna de las dos validaciones (formRequest o rulesValidation) está definida correctamente.'
            ]);
        }
        if (!$validationResult['status']) {
            if ($request->hasFile('image')) {
                $imagen = $request->file('image');
                $nombreArchivo = time() . '.' . $imagen->extension();
                $imagen->move(public_path('/temp'), $nombreArchivo);
                session()->flash('temp_image', [
                    'name' => $imagen->getClientOriginalName(),
                    'path' => asset('temp/' . $nombreArchivo)
                ]);
            }
            return redirect()->back()->withErrors($validationResult['errors'])->withInput();
        }
        $fieldService = new FieldService($node);
        $field_form = $fieldService->getFieldForm();
        foreach ($field_form as $key => $field) {
            $fieldName = $field->name;
            if ($field->type == 'file') {
                // Obtener el archivo de la solicitud
                $file = $request->file($fieldName);
                // Verificar si se proporcionó un archivo
                if ($file) {
                    // Generar un nombre único para el archivo
                    $fileName = uniqid() . '_' . $file->getClientOriginalName();
                    // Almacenar el archivo en el sistema de archivos de Laravel (por defecto, en la carpeta storage/app)
                    $file->storeAs('public/files', $fileName);
                    // Guardar la ruta del archivo en el modelo
                    $model->{$fieldName} = 'file/' . $fileName;
                }
            } elseif ($field->type == 'image') {
                $file = $request->file($fieldName);
                if ($file) {
                    $fileName = uniqid() . '_' . $file->getClientOriginalName();
                    $destinationPath = public_path('images/' . $node->name);
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $file->move($destinationPath, $fileName);
                    $model->{$fieldName} = $fileName;
                    session()->forget('temp_image');
                } elseif ($request->has('temp_image_path')) {
                    $tempPath = $request->input('temp_' . $field->name . '_path');
                    $tempFileName = basename(parse_url($tempPath, PHP_URL_PATH));
                    if (file_exists(public_path('temp/' . $tempFileName))) {
                        $imageName = time() . '_' . $tempFileName;
                        \Illuminate\Support\Facades\File::move(
                            public_path('temp/' . $tempFileName),
                            public_path('images/' . $node->name . '/' . $imageName)
                        );
                        $model->{$fieldName} = $imageName;
                        session()->forget('temp_image');
                    }
                }
            } elseif ($field->type == 'password') {
                $model->$fieldName = bcrypt($request->$fieldName);
            } elseif ($field->type == 'checkbox') {
                $model->$fieldName = is_array($request->$fieldName) ? json_encode($request->$fieldName) : $request->$fieldName;
            } else {
                $model->$fieldName = $request->$fieldName;
            }
        }
        $model->update();
        return redirect()->route('model.list', ['nodeName' => $nodeName])->with('message_success', 'Registro actualizado correctamente');
    }

    public function delete($nodeName, $id)
    {
        $node = Node::where('name', $nodeName)->first();
        if (!$node) return abort(404);
        if (!class_exists($node->model)) return abort(404);
        $model = new $node->model;
        $model = $model->find($id);
        if (!$model) return abort(404);
        $model->delete();
        return redirect()->route('model.list', ['nodeName' => $nodeName])->with('message_success', 'Registro eliminado correctamente');
    }

    public function updateOrderNode(Request $request, $nodeName)
    {
        Log::info('updateOrderNode');
        $node = Node::where('name', $nodeName)->first();
        if (!$node) return abort(404);
        $order = $request->display_order;
        $list = $request->display_list;
        foreach ($order as $key => $value) {
            Field::where('name', $value)->where('parent_id', $node->id)->update(['order' => ($key + 1)]);
        }
        // cmabiamos todos los fields a excel
        Field::where('parent_id', $node->id)->update(['display_list' => 'excel']);
        foreach ($list as $key => $value) {
            Field::where('name', $value)->where('parent_id', $node->id)->update(['display_list' => 'show']);
        }
        return redirect()->route('model.list', ['nodeName' => $nodeName])->with('message_success', 'Orden actualizado correctamente');
    }

    public function createFilters(Request $request, $nodeName)
    {
        $node = Node::where('name', $nodeName)->first();
        if (!$node) return abort(404);
        Log::info('createFilters');
        Log::info($request->all());
        // creamos el filtro
        $filter = new Filter();
        $filter->parent_id = $node->id;
        $filter->name = $request->name;
        if ($request->field_relation != null) {
            $filter->label = 'f_' . $request->value . '_' . $request->field_relation;
        } else {
            $filter->label = $request->field;
        }
        $filter->operator = $request->operator;
        $filter->field_name = $request->field;
        $filter->field_relation = $request->field_relation;
        $filter->value = $request->value;
        $filter->type = $request->type;
        $filter->save();
        return redirect()->route('model.list', ['nodeName' => $nodeName])->with('message_success', 'Filtro creado correctamente');
    }

    public function ajaxRelationNode(Request $request, $nodeName)
    {
        $node = Node::where('name', $nodeName)->first();
        if (!$node) return abort(404);
        $fieldService = new FieldService($node);
        $field = $fieldService->getById($request->id);
        $fieldRelation = $fieldService->getFieldRelation($field);
        return response()->json($fieldRelation);
    }

    //exporar datos
    public function exportNode(Request $request, $nodeName)
    {
        \Log::info('exportNode');
        \Log::info($nodeName);
        $node = Node::where('name', $nodeName)->first();
        if (!$node) return abort(404);
        if (!class_exists($node->model)) return abort(404);
        $model = new $node->model;
        $hiddenFields = (new $node->model)->getHidden();
        $fieldService = new FieldService($node);
        $fields_name = $fieldService->getFieldExcel()->pluck('name')->reject(fn($field) => in_array($field, $hiddenFields))->values();
        $fields_tratucction = collect($fields_name)->map(fn($field) => __("field." . str_replace("field.", "", $field)))->toArray();
        $nodeService = new NodeService($model);
        $data = $nodeService->getExcel($fields_name)->toArray();
        $excel = new ReportExcel();
        return $excel->generateExcel($fields_tratucction, $data, $nodeName, $nodeName);
    }
}
