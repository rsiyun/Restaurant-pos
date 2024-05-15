<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Controller;  //

class BaseController extends Controller
{
    /**
     * success response method
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($object, $data, $message)
    {
        $response = [
            'message' => 'All ' . $object,
            'success' => true,
            'data' => $data,
            'messages' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendGetData($object, $data, $message)
    {
        $responseData = [
            'message' => 'Get a ' . $object,
            'status' => true,
            'data' => $data,
            'messages' => $message,
        ];

        return response()->json($responseData, 200);
    }

    public function sendPost($object, $data, $message)
    {
        $response = [
            'message' => $object . ' Successfully Created',
            'success' => true,
            'data' => $data,
            'messages' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendUpdate($object, $data, $message)
    {
        $response = [
            'message' => $object . ' Successfully Updated',
            'success' => true,
            'data' => $data,
            'messages' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendDelete($object, $data, $message)
    {
        $response = [
            'message' => $object . ' Successfully Deleted',
            'success' => true,
            'data' => $data,
            'messages' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response method
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
