<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 07/12/17
 * Time: 01:22 ص
 */

namespace App\Repositories;

use Illuminate\Support\Collection;

interface RepositoryContract
{

    public static function bulkUpdate($table, $values, $index);

    public function findById($id);

    public function create($data);

    public function update($data);

    public function where($key, $operator, $value = null);

    public function with($relations);

    public function withCount($relations);

    public function join($table, $first_key, $operator, $second_key);

    public function groupBy($attribute);

    public function delete();

    public function forceDelete();

    public function get(): Collection;

    public function toArray();

    public function first();

    public function paginate($number);

    public function setModel($model);

    public function whereIn($key, $array): RepositoryContract;

    public function whereHas($relation, $callback);

    public function whereDate($key, $operator, $value = null);

    public function whereNull($key);

    public function whereNotNull($key);

    public function insert($arrays);

    public function orWhereIn($key, $value);

    public function withTrashed();

    public function pluck($value, $key = null);

    public function orderBy($property, $order = 'asc');

    public function toSql();

    public function union($table);

    public function destroy($id);

    public function has($relation);

    public function doesnthave($relation);

    public function latest();

    public function select($array = []);

    public function firstOrCreate($data);

    public function whereDoesntHave($relation, $callback);
}