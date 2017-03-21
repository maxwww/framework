<?php

namespace Msoroka\Framework;

use Msoroka\Framework\Request\Request;
use Msoroka\Framework\Router\Exception\RouteNotFoundException;
use Msoroka\Framework\Router\Router;
use Msoroka\Framework\Response\Response;

/**
 * Class Application
 * Msoroka Framework application instance class
 *
 * @package Msoroka\Framework
 */
class Application
{
    /**
     * @var array App config
     */
    public $config = [];

    /**
     * Application constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->config = $config;
    }

    /**
     * Process the request
     */
    public function run()
    {
        $router = new Router($this->config['routes']);

        try {
            $route = $router->getRoute(Request::getRequest());

            $route_controller = $route->getController();
            $route_method = $route->getMethod();
            if (class_exists($route_controller)) {
                $reflectionClass = new \ReflectionClass($route_controller);
                if ($reflectionClass->hasMethod($route_method)) {
                    $controller = $reflectionClass->newInstance();
                    $reflectionMethod = $reflectionClass->getMethod($route_method);
                    $response = $reflectionMethod->invokeArgs($controller, $route->getParams());
                    if ($response instanceof Response) {
                        $response->send();
                    }
                }
            }
        } catch (RouteNotFoundException $e) {
            echo "Route was not found";
        } catch (\Exception $e) {
            echo "Smth went wrong...";
        }
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

}
