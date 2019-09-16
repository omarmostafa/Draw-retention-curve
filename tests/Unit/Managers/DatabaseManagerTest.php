<?php

namespace Tests\Unit\Managers;


use App\Adapters\Implementations\CSVAdapter;
use App\Managers\Implementations\CSVManager;
use App\Managers\Implementations\DatabaseManager;
use App\Models\Applicant;
use App\Repositories\Implementation\ApplicantRepository;
use Tests\TestCase;

class DatabaseManagerTest extends TestCase
{
    /**
     * @var \Mockery
     */
    protected $repository;

    /**
     * @var DatabaseManager
     */
    protected $manager;

    /**
     * setup mockery for csv manager
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->repository = \Mockery::mock(ApplicantRepository::class);
        $this->manager = new DatabaseManager($this->repository);
    }

    /**
     * test get data as collection from manager
     */
    public function testGetDataAsCollection()
    {
        $applicants = factory(Applicant::class, 10)->make();
        $this->repository->shouldReceive('get')
            ->andReturn($applicants)
            ->once();
        $actual_applicants = $this->manager->getData();

        $this->assertEquals($actual_applicants, $applicants);
    }

    /**
     * test get data as collection from manager
     */
    public function testGetDataAsArray()
    {
        $applicants = factory(Applicant::class, 10)->make()->toArray();
        $this->repository->shouldReceive('toArray')
            ->andReturn($applicants)
            ->once();
        $actual_applicants = $this->manager->getDataAsArray();

        $this->assertEquals($actual_applicants, $applicants);
    }
}
