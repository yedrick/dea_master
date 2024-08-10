<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CrudNodeService {

    protected $model;

    public function __construct( $model) {
        $this->model = $model;
    }

    public function all():Collection {
        return $this->model::get();
    }

    public function getById(int $id):?Model {
        return $this->model::find($id);
    }

    public function create(array $data):Model {
        return $this->model::create($data);
    }

    public function update(array $data, int $id):bool {
        return $this->model::find($id)->update($data);
    }

    public function delete(int $id):bool {
        return $this->model::find($id)->delete();
    }

    

}
