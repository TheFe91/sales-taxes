<?php


namespace AppBundle\Services;


use Symfony\Component\HttpFoundation\JsonResponse;

class Responder
{
    public static function generateResponse($data = array()): JsonResponse
    {
        return new JsonResponse(array_merge(array('code' => 'OK'), $data));
    }

    public static function generateError($message = '', $trace = null): JsonResponse
    {
        return new JsonResponse(array('code' => 'KO', 'message' => $message, 'trace' => $trace));
    }
}