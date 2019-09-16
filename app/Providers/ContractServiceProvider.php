<?php

namespace App\Providers;

use App\Adapters\CSVAdapterContract;
use App\Adapters\Implementations\CSVAdapter;
use App\Managers\DataManagerContract;
use App\Managers\Implementations\CSVManager;
use App\Repositories\ApplicantRepositoryContract;
use App\Repositories\Implementation\ApplicantRepository;
use App\Services\ChartServiceContract;
use App\Services\Implementations\ChartService;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class ContractServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    public function register()
    {
        $this->app->bind(DataManagerContract::class, CSVManager::class);
        $this->app->bind(ChartServiceContract::class, ChartService::class);
        $this->app->bind(CSVAdapterContract::class, CSVAdapter::class);
        $this->app->bind(ApplicantRepositoryContract::class, ApplicantRepository::class);
    }
}
