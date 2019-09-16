<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 01/01/18
 * Time: 11:25 ص
 */

namespace App\Repositories\Implementation;

use App\Repositories\RepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Repository implements RepositoryContract
{
    /**
     * @var Model|Builder|\Illuminate\Database\Eloquent\Builder $model
     */
    protected $model;

    /**
     * database model only
     * @var Model $data_base_model
     */
    protected $data_base_model;

    /**
     * update bulk
     *
     * @param $arrays
     * @param $key
     * @return bool
     */
    public static function bulkUpdate($table, $values, $index)
    {
        $final = array();
        $ids = array();
        if (!count($values))
            return false;
        if (!isset($index) AND empty($index))
            return false;
        foreach ($values as $key => $val) {
            $ids[] = $val[$index];
            foreach (array_keys($val) as $field) {
                if ($field !== $index) {
                    $value = (is_null($val[$field]) ? 'NULL' : '"' . $val[$field] . '"');
                    $final[$field][] = 'WHEN `' . $index . '` = "' . $val[$index] . '" THEN ' . $value . ' ';
                }
            }
        }
        $cases = '';
        foreach ($final as $k => $v) {
            $cases .= '`' . $k . '` = (CASE ' . implode("\n", $v) . "\n"
                . 'ELSE `' . $k . '` END), ';
        }
        $query = "UPDATE `$table` SET " . substr($cases, 0, -2) . " WHERE `$index` IN(" . implode(',', $ids) . ");";
        return DB::statement($query);
    }

    /**
     * set database model to object
     * @param $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;
        $this->data_base_model = $model;
        return $this;
    }

    /**
     * create a new record in database
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * find record by primary key
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $model = $this->model->find($id);
        $this->resetModel();
        return $model;
    }

    /**
     * reset model object query
     */
    public function resetModel()
    {
        $this->model = $this->data_base_model;
    }

    /**
     * find record where permission
     * @param $key
     * @param null $operator
     * @param null $value
     * @return $this
     */
    public function where($key, $operator = null, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $item => $value) {
                if (is_array($value)) {
                    if (count($value) === 3) {
                        list($field, $operator, $search) = $value;
                        $this->model = $this->model->where($field, $operator, $search);
                    } else if (count($value) === 2) {
                        list($field, $search) = $value;
                        $this->model = $this->model->where($field, $search);
                    }
                } else {
                    $this->model = $this->model->where($item, $value);
                }
            }
        } else if ($value)
            $this->model = $this->model->where($key, $operator, $value);
        else if (isset($operator))
            $this->model = $this->model->where($key, $operator);
        else
            $this->model = $this->model->where($key);
        return $this;
    }

    public function selectRaw($raw)
    {
        $this->model = $this->model->selectRaw($raw);
        return $this;
    }

    /**
     * find record where permission
     * @param $key
     * @param null $operator
     * @param null $value
     * @return $this
     */
    public function orWhere($key, $operator = null, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $item => $value) {
                if (is_array($value)) {
                    if (count($value) === 3) {
                        list($field, $operator, $search) = $value;
                        $this->model = $this->model->orWhere($field, $operator, $search);
                    } else if (count($value) === 2) {
                        list($field, $search) = $value;
                        $this->model = $this->model->orWhere($field, $search);
                    }
                } else {
                    $this->model = $this->model->orWhere($item, $value);
                }
            }
        } else if ($value)
            $this->model = $this->model->orWhere($key, $operator, $value);
        else if ($operator)
            $this->model = $this->model->orWhere($key, $operator);
        else
            $this->model = $this->model->orWhere($key);
        return $this;
    }

    /**
     * @param $key
     * @param $operator
     * @param null $value
     * @return $this
     */
    public function whereDate($key, $operator, $value = null)
    {
        if ($value)
            $this->model = $this->model->whereDate($key, $operator, $value);
        else
            $this->model = $this->model->whereDate($key, $operator);
        return $this;
    }

    /**
     * with relationship function
     * @param $relations
     * @return $this
     */
    public function with($relations)
    {
        if (!$relations) {
            return $this;
        }

        $this->model = $this->model->with($relations);
        return $this;
    }

    /**
     * withCount relationship function
     * @param $relations
     * @return $this
     */
    public function withCount($relations)
    {
        $this->model = $this->model->withCount($relations);
        return $this;
    }

    /**
     * @param $table
     * @param $first_key
     * @param $operator
     * @param $second_key
     * @return $this
     */
    public function join($table, $first_key, $operator, $second_key)
    {
        $this->model = $this->model->join($table, $first_key, $operator, $second_key);
        return $this;
    }

    /**
     * @param $table
     * @param $first_key
     * @param $operator
     * @param $second_key
     * @return $this
     */
    public function leftJoin($table, $first_key, $operator, $second_key)
    {
        $this->model = $this->model->leftJoin($table, $first_key, $operator, $second_key);
        return $this;
    }

    /**
     * @param $attribute
     * @return $this
     */
    public function groupBy($attribute)
    {
        $this->model = $this->model->groupBy($attribute);
        return $this;
    }

    /**
     * get first record in database
     * @return mixed
     */
    public function first()
    {
        $model = $this->model->first();
        $this->resetModel();
        return $model;
    }

    /**
     * get all matched data in database
     * @return Collection
     */
    public function get(): Collection
    {
        $collection = $this->model->get();
        $this->resetModel();
        return $collection;
    }

    /**
     * @return int
     */
    public function count()
    {
        $model = $this->model->count();
        $this->resetModel();
        return $model;
    }

    /**
     * convert object to array
     */
    public function toArray()
    {
        $model = $this->model->get()->toArray();
        $this->resetModel();
        return $model;
    }

    /**
     * paginate data limit number
     * @param $number
     * @return mixed
     */
    public function paginate($number)
    {
        $model = $this->model->paginate($number);
        $this->resetModel();
        return $model;
    }

    /**
     * update data in database
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        $model = $this->model->update($data);
        $this->resetModel();
        return $model;
    }

    public function updateOrCreate($data, $new_data)
    {
        $model = $this->model->updateOrCreate($data, $new_data);
        $this->resetModel();
        return $model;
    }

    /**
     * delete data in database
     * @return mixed
     */
    public function delete()
    {
        return $this->model->delete();
    }

    /**
     * force delete data in database
     * @return bool|mixed|null
     */
    public function forceDelete()
    {
        return $this->model->forceDelete();
    }

    /**
     * where in function database
     * @param string $key
     * @param array $array
     * @return Repository
     */
    public function whereIn($key, $array): RepositoryContract
    {
        $this->model = $this->model->whereIn($key, $array);
        return $this;
    }

    /**
     *
     * @param $relation
     * @param $callback
     * @return $this
     */
    public function whereHas($relation, $callback)
    {
        $this->model = $this->model->whereHas($relation, $callback);
        return $this;
    }

    /**
     *
     * @param $relation
     * @param $callback
     * @return $this
     */
    public function whereDoesntHave($relation, $callback)
    {
        $this->model = $this->model->whereDoesntHave($relation, $callback);
        return $this;
    }

    public function orWhereHas($relation, $callback)
    {
        $this->model = $this->model->orWhereHas($relation, $callback);
        return $this;
    }

    /**
     * @param $key
     * @return $this
     */
    public function whereNull($key)
    {
        $this->model = $this->model->whereNull($key);
        return $this;
    }

    /**
     * @param $key
     * @return $this
     */
    public function whereNotNull($key)
    {
        $this->model = $this->model->whereNotNull($key);
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function pluck($key, $value = null)
    {
        $model = $this->model->pluck($key, $value);
        $this->resetModel();
        return $model;
    }

    /**
     * insert bulk of rows
     * @param $arrays
     * @return mixed
     */
    public function insert($arrays)
    {
        return $this->model->insert($arrays);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function orWhereIn($key, $value)
    {
        return $this->model->orWhereIn($key, $value);
    }

    /**
     * @return mixed
     */
    public function withTrashed()
    {
        return $this->model->withTrashed();
    }

    /**
     * @param $relation
     * @return Repository
     */
    public function has($relation)
    {
        $this->model = $this->model->has($relation);
        return $this;
    }

    /**
     * @param $relation
     * @return $this
     */
    public function doesnthave($relation)
    {
        $this->model = $this->model->doesnthave($relation);
        return $this;
    }

    /**
     * order by query
     *
     * @param $property
     * @param string $order
     * @return Repository
     */
    public function orderBy($property, $order = 'asc')
    {
        $this->model = $this->model->orderBy($property, $order);
        return $this;
    }

    /**
     * order by query
     *
     * @param $raw
     * @return Repository
     */
    public function orderByRaw($raw)
    {
        $this->model = $this->model->orderByRaw($raw);
        return $this;
    }


    /**
     * sql query with bindings
     * @return string
     */
    public function toSql()
    {
        return vsprintf(str_replace('?', '%s', $this->model->toSql()), collect($this->model->getBindings())->map(function ($binding) {
            return is_numeric($binding) ? $binding : "'{$binding}'";
        })->toArray());
    }

    /**
     * union two tables
     * @param $table
     * @return $this
     */
    public function union($table)
    {
        $this->model = $this->model->union($table);
        return $this;
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    public function latest()
    {
        return $this->model->latest();
    }

    public function select($array = [])
    {
        $this->model = $this->model->select($array);
        return $this;
    }

    /**
     * @param $data
     * @return Model
     */
    public function firstOrCreate($data)
    {
        $model = $this->model->firstOrCreate($data);
        $this->resetModel();
        return $model;
    }

    public function distinct()
    {
        $this->model = $this->model->distinct();
        return $this;
    }
}