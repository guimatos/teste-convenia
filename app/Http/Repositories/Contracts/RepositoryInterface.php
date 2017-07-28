<?php

namespace App\Http\Repositories\Contracts;

interface RepositoryInterface {

    public function all($columns = array('*'));

    public function paginate($perPage = 15, $columns = array('*'));

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id, $columns = array('*'));

    public function findBy($field, $value, $columns = array('*'));

    public function findAllBy($field, $value, $columns = array('*'));

    public function findAllByPaginate($field, $value, $paginate = 20);

    public function truncate();
}
