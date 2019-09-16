<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Applicant
 * @package App\Models
 * @property int user_id
 * @property int onboarding_perentage
 * @property int count_applications
 * @property int count_accepted_applications
 * @property Carbon created_at
 */
class Applicant extends Model
{
    protected $table = 'applicants';

    /**
     * @var array
     */
    protected $casts = [];

    /**
     * @var array
     */
    protected $dates = [];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * On boarding flow percentages
     */
    public const BOARDING_FLOW = [0, 20, 40, 50, 70, 90, 99, 100];
}
