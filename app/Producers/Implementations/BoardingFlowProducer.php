<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 7/12/19
 * Time: 5:32 PM
 */

namespace App\Producers\Implementations;


use App\Producers\BoardingFlowProducerContract;
use App\Producers\DataProducerContract;
use App\Models\Applicant;
use App\Services\ChartServiceContract;
use Illuminate\Support\Collection;

class BoardingFlowProducer implements BoardingFlowProducerContract
{
    /**
     * @var Collection
     */
    protected $users_percentage;

    /**
     * @var integer
     */
    protected $count;

    /**
     * @var integer
     */
    protected $onBoardingFlowPercentage;

    /**
     * BoardingFlowProducer constructor.
     * @param $percentage
     */
    public function __construct($percentage)
    {
        $this->count = 0;
        $this->onBoardingFlowPercentage = $percentage;
        $this->users_percentage = 0;
    }

    /**
     * calculate percentage of all users in this board flow percentage
     * @param $countOfAllUsers
     */
    public function setPercentage($countOfAllUsers)
    {
        $this->count++;
        $this->updateUserPercentage($countOfAllUsers);
    }

    /**
     * update percentage of all user for this board without updating flow percentage
     * @param $countOfAllUsers
     */
    public function updateUserPercentage($countOfAllUsers)
    {
        $this->users_percentage = $this->count / $countOfAllUsers * 100;
    }

    /**
     * @return Collection
     */
    public function getUsersPercentage()
    {
        return $this->users_percentage;
    }

    /**
     * @return int
     */
    public function getOnBoardingFlowPercentage()
    {
        return $this->onBoardingFlowPercentage;
    }


}