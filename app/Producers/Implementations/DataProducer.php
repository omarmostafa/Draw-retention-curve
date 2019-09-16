<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 7/12/19
 * Time: 5:32 PM
 */

namespace App\Producers\Implementations;


use App\Producers\DataProducerContract;
use App\Models\Applicant;
use App\Producers\WeeklyLineProducerContract;
use App\Services\ChartServiceContract;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DataProducer implements DataProducerContract
{
    /**
     * @var Collection
     */
    protected $data;

    /**
     * @var Collection
     */
    protected $weeklyLines;

    /**
     * DataProducer constructor.
     * @param Collection $data
     */
    public function __construct(Collection $data)
    {
        $this->set($data);
    }

    /**
     * @param Collection $data
     */
    private function set(Collection $data)
    {
        $this->data = $data;
        $this->weeklyLines = collect();
        $this->calculateData();
    }


    /**
     * loop on all data and check if it will be in new week it will create
     * a weekly line and else it will assign applicant to his weekly line object
     */
    public function calculateData()
    {
        $this->data->each(function (Applicant $applicant) {
            $weekStart = $applicant->created_at->startOfWeek();
            if ($this->weeklyLines->has($weekStart->toDateString())) {
                /*** @var WeeklyLineProducerContract $weeklyLine */
                $weeklyLine = $this->weeklyLines->get($weekStart->toDateString());
            } else {
                $weeklyLine = $this->createWeeklyLine($weekStart);
                $this->weeklyLines->put($weekStart->toDateString(), $weeklyLine);
            }
            $weeklyLine->setApplicantToWorkFlow($applicant);
        });
    }

    /**
     * create new instance of weekly line by week start and all working flow percentages
     * @param Carbon $weekStart
     * @return WeeklyLineProducerContract
     */
    private function createWeeklyLine(Carbon $weekStart): WeeklyLineProducerContract
    {
        return new WeeklyLineProducer($weekStart, $this->getAllWorkFlowPercentages());
    }

    /**
     * return an collection of weekly lines of data
     * @return Collection
     */
    public function getWeeklyLines(): Collection
    {
        return $this->weeklyLines;
    }

    /**
     * return all on boarding flow percentages
     * @return array
     */
    public function getAllWorkFlowPercentages()
    {
        return Applicant::BOARDING_FLOW;
    }


}