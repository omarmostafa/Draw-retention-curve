<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Adapters\CSVAdapterContract;
use App\Imports\UsersImport;
use App\Managers\Implementations\CSVManager;
use App\Models\Applicant;

class CreateApplicantsTable extends Migration
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('onboarding_perentage')->nullable();
            $table->integer('count_applications');
            $table->integer('count_accepted_applications');
            $table->timestamps();
        });
        if (env('APP_ENV') != 'unit_testing') {
            /*** @var CSVAdapterContract $csvAdapter */
            $csvAdapter = app()->make(CSVAdapterContract::class);
            $items = $csvAdapter->getDataAsArray(UsersImport::class, CSVManager::PATH);
            Applicant::insert($items);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
}
