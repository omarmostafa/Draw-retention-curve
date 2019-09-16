<?php

namespace App\Exceptions\CustomExceptions;


use App\Exceptions\CustomException;
use Symfony\Component\HttpFoundation\Response;

class ValidationException extends CustomException
{
    /**
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function render()
    {
        return $this->setStatusCode(Response::HTTP_BAD_REQUEST)->respondWithErrors();
    }
}
