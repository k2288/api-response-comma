<?php
namespace Raahin\ApiResponse;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class ApiResponse
{
    static public function BaseAnswer($data,$status)
    {
        if ($status != 200)
            $data = [
                'status' => $status,
                'message' => $data
            ];
        else
            $data = [
                'status' => $status,
                'response' => $data
            ];

        return response($data,$status);
    }

    static public function render(Throwable $e)
    {

        if($e instanceof ModelNotFoundException){
            $data = [
                'status' => 404,
                'message' => __('message-errors.404')
            ];
        }
        elseif($e instanceof ValidationException){
            $data = [
                'status' => 422,
                'message' => $e->validator->errors()
            ];
        }
        elseif($e instanceof HttpResponseException){
            $data = [
                'status' => 500,
                'message' => __('message-errors.500')
            ];
        }
        elseif($e instanceof MethodNotAllowedHttpException){
            $data = [
                'status' => 405,
                'message' => __('message-errors.405')
            ];
        }
        elseif($e instanceof AuthenticationException){
            $data = [
                'status' => 401,
                'message' => __('message-errors.401')
            ];
        }
        elseif($e instanceof UnauthorizedException){
            $data = [
                'status' => 403,
                'message' => __('message-errors.403')
            ];
        }
        elseif($e instanceof ClientException){
            $data = [
                'status' => $e->getCode(),
                'message' => (string)$e->getResponse()->getBody()
            ];
        }
        else{
            $data = [
                'status' => 404,
                'message' => "Not Found"
            ];
        }

        return self::BaseAnswer($data['message'],$data['status']);
    }
}
