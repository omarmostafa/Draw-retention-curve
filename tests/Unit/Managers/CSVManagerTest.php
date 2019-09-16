<?php

namespace Tests\Unit\Managers;


use App\Adapters\Implementations\CSVAdapter;
use App\Managers\Implementations\CSVManager;
use App\Models\Applicant;
use Tests\TestCase;

class CSVManagerTest extends TestCase
{
    /**
     * @var \Mockery
     */
    protected $adapter;

    /**
     * @var CSVManager
     */
    protected $manager;

    /**
     * setup mockery for csv manager
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->adapter = \Mockery::mock(CSVAdapter::class);
        $this->manager = new CSVManager($this->adapter);
    }

    /**
     * test get data as collection from manager
     */
    public function testGetDataAsCollection()
    {
        $applicants = factory(Applicant::class, 10)->make();
        $this->adapter->shouldReceive('getDataAsCollection')
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
        $this->adapter->shouldReceive('getDataAsArray')
            ->andReturn($applicants)
            ->once();
        $actual_applicants = $this->manager->getDataAsArray();

        $this->assertEquals($actual_applicants, $applicants);
    }
}
