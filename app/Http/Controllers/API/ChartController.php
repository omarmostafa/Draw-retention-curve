<?php

namespace App\Http\Controllers\API;

use App\Services\ChartServiceContract;
use App\Transformers\BoardingFlowTransformer;
use App\Transformers\WeeklyLineTransformer;
use Illuminate\Http\Request;
use Saad\Fractal\Fractal;

/**
 * @SWG\Swagger(
 *     schemes={"http","https"},
 *     host="localhost:7070",
 *     basePath="/api",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="This is for retention chart",
 *         termsOfService="",
 *         @SWG\Contact(
 *             email="omarmostafa1411@gmail.com"
 *         ),
 *     ),
 * )
 */
class ChartController extends ApiController
{
    /**
     * @var ChartServiceContract
     */
    protected $service;

    /**
     * ChartController constructor.
     * @param ChartServiceContract $service
     */
    public function __construct(ChartServiceContract $service)
    {
        $this->service = $service;
    }

    /**
     * @SWG\Get(
     *      path="/v1/charts",
     *      tags={"Retention Chart"},
     *      summary="Get upcase retention chart data",
     *      description="
     *          Get onboarding flow percentages and percentage of users per week
     *     ",
     *      operationId="getOnBoardingFlowChartData",
     *      consumes={"application/json"},
     *      produces={"application/json"},
     *
     *      security={{"api_key": {}}},
     *     @SWG\Info(
     *     ),
     *
     *      @SWG\Response(
     *          response=200,
     *          description="Chart data retrieved successfully",
     *          @SWG\Schema(
     *              @SWG\Property(property="Data", type="object",
     *                  @SWG\Property(property="users_percentage", type="array",
     *                       @SWG\Items(type="object",
     *                          @SWG\Property(property="name", type="string", example="25-10-2019"),
     *                          @SWG\Property(property="data", type="array",
     *                              @SWG\Items(type="integer" ,example=100),
     *                              @SWG\Items(type="integer" ,example=70),
     *                              @SWG\Items(type="integer" ,example=50),
     *                              @SWG\Items(type="integer" ,example=40),
     *                              @SWG\Items(type="integer" ,example=30),
     *                              @SWG\Items(type="integer" ,example=20),
     *                              @SWG\Items(type="integer" ,example=10),
     *                           ),
     *                      ),
     *                  ),
     *                  @SWG\Property(property="boarding_flow_percentage", type="array",
     *                          @SWG\Items(type="integer", example=0),
     *                          @SWG\Items(type="integer", example=20),
     *                          @SWG\Items(type="integer", example=40),
     *                          @SWG\Items(type="integer", example=50),
     *                          @SWG\Items(type="integer", example=70),
     *                          @SWG\Items(type="integer", example=90),
     *                          @SWG\Items(type="integer", example=99),
     *                          @SWG\Items(type="integer", example=100),),
     *              )
     *          )
     *      )
     *  )
     */

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOnboardingFlowChartData(Request $request)
    {
        $data = $this->service->getUsersData()->calculateData();
        $data = Fractal::create($data, new BoardingFlowTransformer());
        return $this->respondAccepted("Chart data retrieved successfully", $data);
    }
}
