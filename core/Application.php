<?php

namespace app\core;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\core
 **/
class Application {
    public Router $router;

    public Request $request;

    public Response $response;

    private Controller $controller;

    public static Application $app;

    public static string $ROOT_DIR;
    public function __construct($rootPath) {
        $this->request = new Request();
        $this->response = new Response();

        $this->router = new Router($this->request, $this->response);
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
    }

    public function run() {
        echo $this->router->resolve();
    }

    /**
     * @return Controller
     */
    public function getController(): Controller {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void {
        $this->controller = $controller;
    }
}