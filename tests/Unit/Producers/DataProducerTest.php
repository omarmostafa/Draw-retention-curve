<?php

namespace Tests\Unit\Producers;

use App\Models\Applicant;
use App\Producers\BoardingFlowProducerContract;
use App\Producers\Implementations\DataProducer;
use App\Producers\Implementations\WeeklyLineProducer;
use App\Producers\WeeklyLineProducerContract;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Tests\TestCase;

class DataProducerTest extends TestCase
{
    /**
     * test calculate data with one week
     *
     * @return void
     */
    public function testCalculateDataWithOneWeek()
    {
        $weeks = [Carbon::today()->toDateString() => [100, 40, 70, 40, 90, 99, 70, 90, 40, 70]];
        $applicants = $this->createApplicants($weeks);
        $producer = new DataProducer($applicants);
        /*** @var WeeklyLineProducerContract $weeklyLine */
        $weeklyLine = $producer->getWeeklyLines()->first();
        # assert equal that this week as the week start
        $this->assertEquals($weeklyLine->getWeekStart(), Carbon::today()->startOfWeek());
        # expected percentages that will get from this data producers
        $expected_percentages = [0 => 100, 20 => 100, 40 => 100, 50 => 70, 70 => 70, 90 => 40, 99 => 20, 100 => 10];
        # assert equal all percentages with expected
        $weeklyLine->getOnBoardWorkFlowPercentage()->each(function (BoardingFlowProducerContract $boardingFlowProducerContract) use ($expected_percentages) {
            $this->assertEquals($boardingFlowProducerContract->getUsersPercentage(), $expected_percentages[$boardingFlowProducerContract->getOnBoardingFlowPercentage()]);
        });
    }

    /**
     * Create applicants objects with specific dates and percentages
     * @param $weeks
     * @return Collection
     */
    public function createApplicants($weeks): Collection
    {
        $applicants = collect();
        foreach ($weeks as $date => $percentages) {
            foreach ($percentages as $percentage) {
                $applicants->push(factory(Applicant::class)->make(['onboarding_perentage' => $percentage, 'created_at' => $date]));
            }
        }
        return $applicants;
    }

    /**
     * test calculate data with one week
     *
     * @return void
     */
    public function testCalculateDataWithMultipleWeeks()
    {
        $weeks = [
            Carbon::today()->toDateString() => [100, 40, 90, 40, 90, 99, 20, 90, 40, 70],
            Carbon::today()->addWeek()->toDateString() => [40, 100, 90, 99, 70, 100, 20, 50, 20, 40]
        ];
        $applicants = $this->createApplicants($weeks);
        $producer = new DataProducer($applicants);
        $weeklyLines = $producer->getWeeklyLines();
        # expected percentages of two weeks
        $expected_percentages_of_all_weeks = [
            Carbon::today()->startOfWeek()->toDateString() => [0 => 100, 20 => 100, 40 => 90, 50 => 60, 70 => 60, 90 => 50, 99 => 20, 100 => 10],
            Carbon::today()->addWeek()->startOfWeek()->toDateString() => [0 => 100, 20 => 100, 40 => 80, 50 => 60, 70 => 50, 90 => 40, 99 => 30, 100 => 20]
        ];
        #assert equals of all percentages and grouping by week
        $weeklyLines->each(function (WeeklyLineProducer $weeklyLine, $week_start) use ($expected_percentages_of_all_weeks) {
            $expected_percentages = $expected_percentages_of_all_weeks[$week_start];
            $weeklyLine->getOnBoardWorkFlowPercentage()->each(function (BoardingFlowProducerContract $boardingFlowProducerContract) use ($expected_percentages) {
                $this->assertEquals($boardingFlowProducerContract->getUsersPercentage(), $expected_percentages[$boardingFlowProducerContract->getOnBoardingFlowPercentage()]);
            });
        });
    }
}
