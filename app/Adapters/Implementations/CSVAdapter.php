<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 7/12/19
 * Time: 5:32 PM
 */

namespace App\Adapters\Implementations;


use App\Adapters\CSVAdapterContract;
use App\Exceptions\CustomExceptions\ValidationException;
use App\Imports\BaseImport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Excel;

class CSVAdapter implements CSVAdapterContract
{
    /**
     * @var Excel
     */
    protected $excel;

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $array;

    /**
     * CSVAdapter constructor.
     * @param Excel $excel
     */
    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
        $this->collection = collect();
        $this->array = [];
    }

    /**
     * get data as collection from importer
     * @param $importer
     * @param $path
     * @return Collection
     * @throws ValidationException
     */
    public function getDataAsCollection($importer, $path): Collection
    {
        $importer = new $importer($this);
        if (!$importer instanceof BaseImport)
            throw new ValidationException("Importable not found");

        $this->excel->import($importer, storage_path($path));
        return $this->collection;
    }

    /**
     * get data as array from CSV file
     * @param $importer
     * @param $path
     * @return array
     * @throws ValidationException
     */
    public function getDataAsArray($importer, $path): array
    {
        $importer = new $importer($this);
        if (!$importer instanceof BaseImport)
            throw new ValidationException("Importable not found");

        $this->excel->import(new $importer($this, true), storage_path($path));
        return $this->array;
    }

    /**
     * push item in the collection of adapter
     * @param $item
     * @return void
     */
    public function pushOnCollection($item)
    {
        $this->collection->push($item);
    }

    /**
     * push item in the array of adapter
     * @param $array
     * @return void
     */
    public function pushOnArray($array)
    {
        array_push($this->array, $array);
    }
}