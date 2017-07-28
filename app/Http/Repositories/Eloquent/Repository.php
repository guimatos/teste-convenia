<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Contracts\RepositoryInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Container\Container as App;

abstract class Repository implements RepositoryInterface
{

    /**
     * @var App
     */
    private $app;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @param App $app
     * @throws
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract function model();

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        $this->makeModel();
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $data['created_at'] = \Carbon\Carbon::now('America/Sao_Paulo')->toDateTimeString();
        $data['updated_at'] = \Carbon\Carbon::now('America/Sao_Paulo')->toDateTimeString();
        return $this->model->insertGetId($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createByArray($data)
    {
        foreach ($data as $key => $item)
        {
            $data[$key]['created_at'] = \Carbon\Carbon::now('America/Sao_Paulo')->toDateTimeString();
            $data[$key]['updated_at'] = \Carbon\Carbon::now('America/Sao_Paulo')->toDateTimeString();
        }

        return $this->model->insert($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mied
     */
    public function update(array $data, $id, $attribute = 'id')
    {
        $data['updated_at'] = \Carbon\Carbon::now('America/Sao_Paulo')->toDateTimeString();
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id, $attribute = 'id')
    {
        return $this->model->where($attribute, '=', $id)->delete();
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->makeModel();
        return $this->model->find($id, $columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        $this->makeModel();
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findAllBy($attribute, $value, $columns = array('*'))
    {
        $this->makeModel();
        return $this->model->where($attribute, '=', $value)->get($columns);
    }

    public function findAllByPaginate($attribute, $value, $paginate = 20)
    {
        $this->makeModel();
        return $this->model->where($attribute, '=', $value)->paginate($paginate);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws RepositoryException
     */
    public function makeModel() {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model->newQuery();
    }

    public function truncate()
    {
        $this->makeModel();
        return $this->model->truncate();
    }

    public function getInOrder($colum, $order)
    {
        $this->makeModel();
        return $this->model->orderBy($colum, $order)->get();
    }

}
