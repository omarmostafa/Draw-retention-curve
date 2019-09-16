<?php

namespace App\Imports;

use App\Adapters\CSVAdapterContract;

class BaseImport
{
    /**
     * @var CSVAdapterContract
     */
    protected $csvAdapter;

    /**
     * @var bool
     */
    protected $asArray;

    /**
     * BaseImport constructor.
     * @param CSVAdapterContract $CSVAdapter
     * @param bool $asArray
     */
    public function __construct(CSVAdapterContract $CSVAdapter, $asArray = false)
    {
        $this->csvAdapter = $CSVAdapter;
        $this->asArray = $asArray;
    }
}
