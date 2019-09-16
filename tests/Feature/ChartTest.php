<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChartTest extends TestCase
{
    /**
     *  send request of chart
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function sendRequest()
    {
        return $this->get($this->getV1Url("charts"));
    }

    /**
     * test of charts endpoint.
     *
     * @return void
     */
    public function testChartsEndpoint()
    {
        $response = $this->sendRequest();
        $response->assertStatus(202);

        # assert boarding flow percentage
        $response->assertJson([
            'data' => [
                'boarding_flow_percentage' => [0, 20, 40, 50, 70, 90, 99, 100]
            ]
        ]);
        # assert sample of week line
        $response->assertJson([
            'data' => [
                'users_percentage' => [
                    [
                        "name" => "2016-07-18",
                        "data" => [
                            100,
                            100,
                            98.66666666666667,
                            44,
                            41.333333333333336,
                            41.333333333333336,
                            40,
                            29.333333333333332
                        ]
                    ]
                ]
            ]
        ]);

    }
}
