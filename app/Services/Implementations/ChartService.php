<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 7/12/19
 * Time: 5:32 PM
 */

namespace App\Services\Implementations;


use App\Producers\DataProducerContract;
use App\Producers\Implementations\DataProducer;
use App\Managers\DataManagerContract;
use App\Services\ChartServiceContract;
use Illuminate\Support\Collection;

class ChartService implements ChartServiceContract
{
    /**
     * @var DataManagerContract
     */
    protected $dataManager;

    /**
     * @var Collection
     */
    protected $data;

    /**
     * ChartService constructor.
     * @param DataManagerContract $dataManager
     */
    public function __construct(DataManagerContract $dataManager)
    {
        $this->dataManager = $dataManager;
    }

    /**
     * get data from CSV or from database
     * @return ChartServiceContract
     */
    public function getUsersData(): ChartServiceContract
    {
        $this->data = $this->dataManager->getData();
        return $this;
    }

    /**
     * Pass data to producer to produce percentages of users
     * @return DataProducerContract
     */
    public function calculateData(): DataProducerContract
    {
        return new DataProducer($this->data);
    }


}