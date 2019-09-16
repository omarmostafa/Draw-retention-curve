<?php

namespace Tests\Unit\Repositories;


use App\Adapters\CSVAdapterContract;
use App\Imports\UsersImport;
use App\Models\Applicant;
use App\Repositories\ApplicantRepositoryContract;
use App\Repositories\RepositoryContract;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ApplicantRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testGetDataAsCollection()
    {
        /*** @var ApplicantRepositoryContract $repository */
        $repository = $this->app->make(ApplicantRepositoryContract::class);
        $expected_applicants = factory(Applicant::class, 10)->create();
        $actual_applicants = $repository->get();
        $this->assertEquals($actual_applicants->map->getAttributes(), $expected_applicants->map->getAttributes());
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testGetDataAsArray()
    {
        /*** @var ApplicantRepositoryContract $repository */
        $repository = $this->app->make(ApplicantRepositoryContract::class);
        $expected_applicants = factory(Applicant::class, 10)->create();
        $actual_applicants = $repository->toArray();
        $this->assertEquals($actual_applicants, $expected_applicants->toArray());
    }
}
