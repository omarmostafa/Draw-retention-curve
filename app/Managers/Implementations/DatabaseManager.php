<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 7/12/19
 * Time: 5:32 PM
 */

namespace App\Managers\Implementations;


use App\Adapters\CSVAdapterContract;
use App\Managers\DataManagerContract;
use App\Repositories\ApplicantRepositoryContract;
use App\Services\ChartServiceContract;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class DatabaseManager implements DataManagerContract
{
    /**
     * @var ApplicantRepositoryContract
     */
    protected $repository;

    /**
     * DatabaseManager constructor.
     * @param ApplicantRepositoryContract $repository
     */
    public function __construct(ApplicantRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * get data from repository as collection
     * @return Collection
     */
    public function getData(): Collection
    {
        return $this->repository->get();
    }

    /**
     * get data from repository as array
     * @return array
     */
    public function getDataAsArray(): array
    {
        return $this->repository->toArray();
    }
}