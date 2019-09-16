<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Get Api V1 Url
     *
     * @param $url
     * @return string
     */
    protected function getV1Url(string $url): string
    {
        return $this->getUrl($url, 'v1');
    }

    /**
     * Get Api Url
     *
     * @param string $url
     * @param string $version
     * @return string
     */
    protected function getUrl(string $url, string $version): string
    {
        return "/api/{$version}/" . trim($url, '/');
    }
}
