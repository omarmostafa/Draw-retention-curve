<?php

/**
 * Created by PhpStorm.
 * User: omar
 * Date: 7/12/19
 * Time: 5:32 PM
 */


namespace App\Transformers;

use App\Producers\WeeklyLineProducerContract;
use League\Fractal\Resource\Primitive;
use Saad\Fractal\Transformers\TransformerAbstract;

class WeeklyLineTransformer extends TransformerAbstract
{
    /**
     * Default Includes
     * @var array
     */
    protected $defaultIncludes = ['name', 'data'];

    /**
     * Available Includes
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * @param WeeklyLineProducerContract $line
     * @return array
     */
    public function transformWithDefault(WeeklyLineProducerContract $line)
    {
        return [

        ];
    }

    /**
     * @param WeeklyLineProducerContract $line
     * @return Primitive
     */
    public function includeName(WeeklyLineProducerContract $line)
    {
        return $this->primitive($line->getWeekStart()->toDateString());
    }

    /**
     * @param WeeklyLineProducerContract $line
     * @return Primitive
     */
    public function includeData(WeeklyLineProducerContract $line)
    {
        return $this->primitive($line->getOnBoardWorkFlowPercentage()->map->getUsersPercentage()->values()->toArray());
    }
}
