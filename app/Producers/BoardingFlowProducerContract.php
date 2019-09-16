<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 7/12/19
 * Time: 4:57 PM
 */

namespace App\Producers;

use App\Models\Applicant;
use Carbon\Carbon;
use Illuminate\Support\Collection;

interface BoardingFlowProducerContract
{
    /**
     * @return Collection
     */
    public function getUsersPercentage();

    /**
     * @return integer
     */
    public function getOnBoardingFlowPercentage();

    /**
     * @param $countOfAllUsers
     */
    public function setPercentage($countOfAllUsers);

    /**
     * @param $countOfAllUsers
     */
    public function updateUserPercentage($countOfAllUsers);
}
