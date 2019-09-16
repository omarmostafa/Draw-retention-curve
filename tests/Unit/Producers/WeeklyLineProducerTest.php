<?php

namespace Tests\Unit\Producers;

use App\Models\Applicant;
use App\Producers\BoardingFlowProducerContract;
use App\Producers\Implementations\WeeklyLineProducer;
use Carbon\Carbon;
use Tests\TestCase;

class WeeklyLineProducerTest extends TestCase
{
    /**
     * test set applicant method to weekly line producer
     *
     * @return void
     */
    public function testSetApplicantToWeekLine()
    {
        $applicant = $this->createApplicant(40);
        $weeklyLine = new WeeklyLineProducer(Carbon::today()->startOfWeek(), Applicant::BOARDING_FLOW);

        $weeklyLine->setApplicantToWorkFlow($applicant);
        # expected percentages that will get from this data producers
        $expected_percentages = [0 => 100, 20 => 100, 40 => 100, 50 => 0, 70 => 0, 90 => 0, 99 => 0, 100 => 0];
        # assert equal all percentages with expected
        $weeklyLine->getOnBoardWorkFlowPercentage()->each(function (BoardingFlowProducerContract $boardingFlowProducerContract) use ($expected_percentages) {
            $this->assertEquals($boardingFlowProducerContract->getUsersPercentage(), $expected_percentages[$boardingFlowProducerContract->getOnBoardingFlowPercentage()]);
        });
        # create another applicants
        $anotherApplicant = $this->createApplicant(100);
        $weeklyLine->setApplicantToWorkFlow($anotherApplicant);
        # expected percentages that will get from this data producers
        $expected_percentages = [0 => 100, 20 => 100, 40 => 100, 50 => 50, 70 => 50, 90 => 50, 99 => 50, 100 => 50];
        # assert equal all percentages with expected
        $weeklyLine->getOnBoardWorkFlowPercentage()->each(function (BoardingFlowProducerContract $boardingFlowProducerContract) use ($expected_percentages) {
            $this->assertEquals($boardingFlowProducerContract->getUsersPercentage(), $expected_percentages[$boardingFlowProducerContract->getOnBoardingFlowPercentage()]);
        });
    }

    /**
     * Create applicants objects with specific dates and percentages
     * @param $percentage
     * @return Applicant
     */
    public function createApplicant($percentage): Applicant
    {
        return factory(Applicant::class)->make(['onboarding_perentage' => $percentage]);
    }
}
