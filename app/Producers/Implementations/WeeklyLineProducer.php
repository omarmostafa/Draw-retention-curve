<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 7/12/19
 * Time: 5:32 PM
 */

namespace App\Producers\Implementations;


use App\Producers\BoardingFlowProducerContract;
use App\Models\Applicant;
use App\Producers\WeeklyLineProducerContract;
use App\Transformers\BoardingFlowTransformer;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class WeeklyLineProducer implements WeeklyLineProducerContract
{
    /**
     * @var float
     */
    protected $percentageOfUsers;

    /**
     * @var Carbon
     */
    protected $weekStart;

    /**
     * @var integer
     */
    protected $count;

    /**
     * @var array
     */
    protected $flowPercentages;

    /**
     * @var Collection
     */
    protected $onBoardingFlowCollection;

    /**
     * WeeklyLineProducer constructor.
     * @param Carbon $weekStart
     * @param $flowPercentages
     */
    public function __construct(Carbon $weekStart, $flowPercentages)
    {
        $this->weekStart = $weekStart;
        $this->flowPercentages = $flowPercentages;
        $this->setOnBoardingWorkFlow();
    }

    /**
     * loop on each percentages and create boarding work flow with each percentage
     */
    private function setOnBoardingWorkFlow()
    {
        $this->onBoardingFlowCollection = collect();
        foreach ($this->flowPercentages as $percentage) {
            $flow = $this->createOnBoardFlow($percentage);
            $this->onBoardingFlowCollection->put($percentage, $flow);
        }
    }

    /**
     * set a new applicant to his board flow percentage
     * @param Applicant $applicant
     */
    public function setApplicantToWorkFlow(Applicant $applicant)
    {
        $this->count++;
        $this->onBoardingFlowCollection->each(function (BoardingFlowProducerContract $flow, $percentage) use ($applicant) {
            # check if his percentage is greater than on boarding flow it will assign him to this percentage
            if ($percentage <= (int)$applicant->onboarding_perentage) {
                $flow->setPercentage($this->count);
            } else {
                $flow->updateUserPercentage($this->count);
            }
        });
    }

    /**
     * @param $percentage
     * @return BoardingFlowProducerContract
     */
    private function createOnBoardFlow($percentage): BoardingFlowProducerContract
    {
        return new BoardingFlowProducer($percentage);
    }

    /**
     * @return Collection
     */
    public function getOnBoardWorkFlowPercentage(): Collection
    {
        return $this->onBoardingFlowCollection;
    }

    /**
     * @return Carbon
     */
    public function getWeekStart(): Carbon
    {
        return $this->weekStart;
    }

}