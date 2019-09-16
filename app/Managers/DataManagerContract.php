<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 7/12/19
 * Time: 4:57 PM
 */

namespace App\Managers;

use Illuminate\Support\Collection;

interface DataManagerContract
{
    /**
     * get Data as collection of users
     * @return Collection
     */
    public function getData(): Collection;

    /**
     * @return array
     */
    public function getDataAsArray(): array;
}
