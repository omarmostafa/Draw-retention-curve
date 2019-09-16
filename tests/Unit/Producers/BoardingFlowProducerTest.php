<?php

namespace Tests\Unit\Producers;


use App\Producers\Implementations\BoardingFlowProducer;
use Tests\TestCase;

class BoardingFlowProducerTest extends TestCase
{
    /**
     * test get percentage of boarding flow
     *
     * @return void
     */
    public function testGetPercentage()
    {
        $boardingFlowPercentage = new BoardingFlowProducer(100);
        $boardingFlowPercentage->setPercentage(5);
        $this->assertEquals($boardingFlowPercentage->getUsersPercentage(), 20);
    }

    /**
     * test update percentage of boarding flow
     *
     * @return void
     */
    public function testUpdatePercentage()
    {
        $boardingFlowPercentage = new BoardingFlowProducer(100);
        $boardingFlowPercentage->setPercentage(5);
        $boardingFlowPercentage->updateUserPercentage(10);
        $this->assertEquals($boardingFlowPercentage->getUsersPercentage(), 10);
    }
}
