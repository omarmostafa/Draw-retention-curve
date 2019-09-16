<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Response;

abstract class CustomException extends Exception
{
    /**
     * @var int|null
     */
    protected $statusCode;

    /**
     * @var array
     */
    protected $errors;

    /**
     * @var array
     */
    protected $extra_data;

    /**
     * @var string
     */
    protected $message;

    /**
     * CustomException constructor.
     * @param $msg
     * @param array $errors
     */
    public function __construct($msg, array $errors = [])
    {
        $this->message = $msg;
        $this->errors = $errors;

        parent::__construct($msg);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return mixed
     */
    abstract function render();

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithErrors()
    {
        return Response::json(['success' => false, 'msg' => $this->message, 'errors' => $this->errors], $this->getStatusCode());
    }

    /**
     * @return int|null
     */
    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
}
