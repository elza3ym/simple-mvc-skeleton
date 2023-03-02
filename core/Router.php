<?php

namespace app\core;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\core
 **/
class Router {

    private Request $request;
    private Response $response;
    private array $routes;

    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback) {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback) {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve() {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false) {
            // TODO: apply view
            return "Not Found";
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0];
        }

        return call_user_func($callback);
    }

    private function viewLayout(string $view, $params = []) {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

    }

    private function layoutContent() {
        $layout = Application::$app->getController()->getLayout();
        ob_start();
        require_once
        ob_get_clean();
    }

    private function renderView() {

    }

}