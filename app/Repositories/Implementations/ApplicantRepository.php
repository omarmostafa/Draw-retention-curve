<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 01/01/18
 * Time: 11:25 ص
 */

namespace App\Repositories\Implementation;

use App\Models\Applicant;
use App\Repositories\ApplicantRepositoryContract;

class ApplicantRepository extends Repository implements ApplicantRepositoryContract
{

    /**
     * set model to Applicant type in main repository
     * ApplicantRepository constructor.
     * @param Applicant $applicant
     */
    public function __construct(Applicant $applicant)
    {
        $this->setModel($applicant);
    }
}