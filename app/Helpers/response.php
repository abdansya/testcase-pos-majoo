<?php

if (! function_exists('sendApiResponse')) {
    /**
     * @param bool $status
     * @param string $message
     * @param null $data
     * @param int $code
     * @param null $error
     * @return \Illuminate\Http\JsonResponse
     */
    function sendApiResponse($status = true, $message = '', $data = null, $code = null)
    {
        $data = [
            'error' => !$status,
            'message' => $message,
            'data' => $data
        ];

        if ($status == false && $code == null) {
            $code = 400;
        } elseif ($status == true && $code == null) {
            $code = 200;
        }
        
        return response()->json($data, $code);
    }
}
