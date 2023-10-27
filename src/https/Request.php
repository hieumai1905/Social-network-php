<?php

namespace https;

class Request
{
    private $data;
    private $method;
    private $uri;
    private $headers;
    private $cookies;

    public function __construct($data, $method, $uri, $headers, $cookies)
    {
        $this->data = $data;
        $this->method = $method;
        $this->uri = $uri;
        $this->headers = $headers;
        $this->cookies = $cookies;
    }

    public function input($key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    public function method()
    {
        return $this->method;
    }

    public function uri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return mixed
     */
    public function getCookies()
    {
        return $this->cookies;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method): void
    {
        $this->method = $method;
    }

    /**
     * @param mixed $uri
     */
    public function setUri($uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @param mixed $cookies
     */
    public function setCookies($cookies): void
    {
        $this->cookies = $cookies;
    }

    public function header($key, $default = null)
    {
        return $this->headers[$key] ?? $default;
    }

    public function cookie($key, $default = null)
    {
        return $this->cookies[$key] ?? $default;
    }
    public static function getRequestCurrent(): Request
    {
        $requestData = $_REQUEST;
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestHeaders = getallheaders();
        $requestCookies = $_COOKIE;
        return new Request($requestData, $requestMethod, $requestUri, $requestHeaders, $requestCookies);
    }
    public static function getModelJson($model)
    {
        $jsonData = json_encode($model);

        // Set the appropriate headers for JSON response
        header('Content-Type: application/json');
        header('Content-Length: ' . strlen($jsonData));

        echo $jsonData;
        exit();
    }

    public static function getArrayJson($array)
    {
        $jsonData = json_encode($array);

        // Set the appropriate headers for JSON response
        header('Content-Type: application/json');
        header('Content-Length: ' . strlen($jsonData));

        echo $jsonData;
        exit();
    }
}