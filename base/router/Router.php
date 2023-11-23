<?php

namespace base\router;
use user\controller\UserController;
class Router {
  private $routes = [];

  protected $currentController = NULL;

  public function __construct() {
    // Define routes
    $this->addRoute('#^/$#', 'UserController', 'index');
    $this->addRoute('/\/login(\?.*)?/', 'UserController', 'handleLogin');
    $this->addRoute('/\/register(\?.*)?/', 'UserController', 'handleRegistration');
    $this->addRoute('#^/logout$#', 'UserController', 'handleLogout');
  }

  // Add a route pattern and its corresponding controller method
  public function addRoute($pattern, $controller, $controllerMethod) {
    $this->routes[$pattern] = [
      'controller' => $controller,
      'method' => $controllerMethod,
    ];
  }
  public function controller() {
    return $this->currentController;
  }

  // Match the current URL to a route pattern and execute the corresponding controller method
  public function route() {
    $uri = $_SERVER['REQUEST_URI'];
    $this->currentController = NULL;
    foreach ($this->routes as $pattern => $route) {
      if (preg_match($pattern, $uri, $matches)) {
        // Extract parameters from the URL if needed
        $params = array_slice($matches, 1);
        // Create an instance of the controller
        // we use this so the autoloader actually works.
        switch ($route['controller']) {
          case 'UserController':
            $this->currentController = new UserController();
            break;
        }
        if (empty($this->currentController)) {
          // Handle 404 (no matching route)
          $this->handle404();
        }
        call_user_func_array([$this->currentController, $route['method']], $params);
        return;
      }
    }
    // Handle 404 (no matching route)
    $this->handle404();
  }

  private function handle404() {
    header('HTTP/1.0 404 Not Found');
    echo '404 Not Found';
  }
}