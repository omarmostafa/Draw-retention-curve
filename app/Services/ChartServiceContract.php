<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 7/12/19
 * Time: 4:57 PM
 */

namespace App\Services;

use App\Producers\DataProducerContract;

interface ChartServiceContract
{
    /**
     * @return ChartServiceContract
     */
    public function getUsersData(): self;

    /**
     * @return DataProducerContract
     */
    public function calculateData(): DataProducerContract;
}
