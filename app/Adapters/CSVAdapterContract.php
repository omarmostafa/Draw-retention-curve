<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 7/12/19
 * Time: 4:57 PM
 */

namespace App\Adapters;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Importer;

interface CSVAdapterContract
{
    /**
     * @param $importer
     * @param $path
     * @return Collection
     */
    public function getDataAsCollection($importer, $path): Collection;

    /**
     * @param $importer
     * @param $path
     * @return array
     */
    public function getDataAsArray($importer, $path): array;

    /**
     * @param $item
     * @return void
     */
    public function pushOnCollection($item);

    /**
     * @param $array
     * @return void
     */
    public function pushOnArray($array);

}
