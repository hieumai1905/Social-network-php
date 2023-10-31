<?php

namespace https;

use JetBrains\PhpStorm\NoReturn;

class Response
{
    public static function view($view, $data = [])
    {
        if (!strpos($view, '.php')) {
            $view .= '.php';
        }
        extract($data);
        require_once __DIR__ . "/../$view";
        exit();
    }

    public static function redirect($url)
    {
        header("Location: $url");
        exit();
    }

    public static function getJson()
    {
        $data = [];
        $data = file_get_contents('php://input');
        return json_decode($data, true);
    }

    public static function jsonToModel($json, $modelClass)
    {
//        $data = json_decode($json, true);
        $data = $json;
        if ($data !== null) {
            $model = new $modelClass();

            foreach ($data as $key => $value) {
                $setterMethod = 'set' . ucfirst($key);

                if (method_exists($model, $setterMethod)) {
                    $model->$setterMethod($value);
                }
            }

            return $model;
        }
        return null;
    }

    #[NoReturn] public static function apiResponse($status = Status::OK, $message = '', $data = []): void
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        http_response_code($response['status']);

        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_SLASHES);
        exit();
    }
}