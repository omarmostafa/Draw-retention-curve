<?php

namespace Tests\Unit\Adapters;


use App\Adapters\CSVAdapterContract;
use App\Imports\UsersImport;
use App\Models\Applicant;
use Tests\TestCase;

class CSVAdapterTest extends TestCase
{

    /**
     * test get data as collection from adapter
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testGetDataAsCollection()
    {
        /*** @var CSVAdapterContract $adapter */
        $adapter = $this->app->make(CSVAdapterContract::class);
        $actual_applicants = $adapter->getDataAsCollection(UsersImport::class, 'data/export-test.csv');

        $expected_applicants = collect()->push(new Applicant([
            'user_id' => 3121.0,
            'created_at' => '2016-07-19',
            'onboarding_perentage' => 40.0,
            'count_applications' => 0.0,
            'count_accepted_applications' => 0.0
        ]));
        $this->assertEquals($actual_applicants, $expected_applicants);
    }

    /**
     * test get data as collection from adapter
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testGetDataAsArray()
    {
        /*** @var CSVAdapterContract $adapter */
        $adapter = $this->app->make(CSVAdapterContract::class);
        $actual_applicants = $adapter->getDataAsArray(UsersImport::class, 'data/export-test.csv');

        $expected_applicants = [
            [
                'user_id' => 3121.0,
                'created_at' => '2016-07-19',
                'onboarding_perentage' => 40.0,
                'count_applications' => 0.0,
                'count_accepted_applications' => 0.0
            ]
        ];
        $this->assertEquals($actual_applicants, $expected_applicants);
    }
}
