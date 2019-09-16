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

interface WeeklyLineProducerContract
{
    /**
     * @return Collection
     */
    public function getOnBoardWorkFlowPercentage(): Collection;

    /**
     * @return Carbon
     */
    public function getWeekStart(): Carbon;

    /**
     * @param Applicant $applicant
     */
    public function setApplicantToWorkFlow(Applicant $applicant);
}
