<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


class BaseController extends Controller
{
    public function sendResponse($result, $message, $status = 200)
    {
        $response = [
            "success" => true,
            "data" => $result,
            "message" => $message,
        ];
        return response()->json($response, $status);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            "success" => false,
            "message" => $error,
        ];

        if (!empty($errorMessages)) {
            $response["data"] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function validationObject($class, $modelId)
    {
        $object = $class::find($modelId);

        if (is_null($object)) {
            return $this->sendError("$class not found.");
        }
        return $object;
    }
}
