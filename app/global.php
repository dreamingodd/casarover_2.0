<?php
    App::error(function(Exception $exception, $code) {
        // 如果没有路径就直接跳转到登录页面
        if ($exception instanceof NotFoundHttpException) {
            return Redirect::route('/');
        }

        Log::error($exception);

        $err = [
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'code' => $exception->getCode(),
            'url' => Request::url(),
            'input' => Input::all(),
        ];
        BLogger::getLogger(BLogger::LOG_ERROR)->error($err);

        $response = [
            'status' => 0,
            'error' => "服务器内部错误",
        ];
        return Response::json($response);

    });