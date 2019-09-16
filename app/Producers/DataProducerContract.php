<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 7/12/19
 * Time: 4:57 PM
 */

namespace App\Producers;

use Illuminate\Support\Collection;

interface DataProducerContract
{
    /**
     * @return Collection
     */
    public function getWeeklyLines(): Collection;

    /**
     * @return array
     */
    public function getAllWorkFlowPercentages();
}
