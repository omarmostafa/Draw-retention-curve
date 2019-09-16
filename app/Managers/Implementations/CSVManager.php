<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 7/12/19
 * Time: 5:32 PM
 */

namespace App\Managers\Implementations;


use App\Adapters\CSVAdapterContract;
use App\Imports\UsersImport;
use App\Managers\DataManagerContract;
use Illuminate\Support\Collection;

class CSVManager implements DataManagerContract
{
    /**
     * path of user data
     */
    public const PATH = 'data/export.csv';
    /**
     * @var CSVAdapterContract
     */
    protected $adapter;

    /**
     * CSVManager constructor.
     * @param CSVAdapterContract $adapter
     */
    public function __construct(CSVAdapterContract $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Call CSV adapter to export data from the file and return it as collection
     * @return Collection
     */
    public function getData(): Collection
    {
        return $this->adapter->getDataAsCollection(UsersImport::class, self::PATH);
    }

    /**
     * Call CSV adapter to export data from the file and return it as array
     * @return array
     */
    public function getDataAsArray(): array
    {
        return $this->adapter->getDataAsArray(UsersImport::class, self::PATH);
    }
}