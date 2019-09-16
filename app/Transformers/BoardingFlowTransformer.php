<?php

/**
 * Created by PhpStorm.
 * User: omar
 * Date: 7/12/19
 * Time: 5:32 PM
 */


namespace App\Transformers;

use App\Producers\BoardingFlowProducerContract;
use App\Producers\DataProducerContract;
use App\Producers\Implementations\DataProducer;
use App\Producers\WeeklyLineProducerContract;
use League\Fractal\Resource\Primitive;
use Saad\Fractal\Transformers\TransformerAbstract;

class BoardingFlowTransformer extends TransformerAbstract
{
    /**
     * Default Includes
     * @var array
     */
    protected $defaultIncludes = ['users_percentage', 'boarding_flow_percentage'];

    /**
     * Available Includes
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * @param DataProducerContract $dataProducer
     * @return array
     */
    public function transformWithDefault(DataProducerContract $dataProducer)
    {
        return [

        ];
    }

    /**
     * @param DataProducerContract $dataProducer
     * @return \League\Fractal\Resource\Collection
     */
    public function includeUsersPercentage(DataProducerContract $dataProducer)
    {
        return $this->collection($dataProducer->getWeeklyLines(), new WeeklyLineTransformer());
    }

    /**
     * @param DataProducerContract $dataProducer
     * @return Primitive
     */
    public function includeBoardingFlowPercentage(DataProducerContract $dataProducer)
    {
        return $this->primitive($dataProducer->getAllWorkFlowPercentages());
    }
}
