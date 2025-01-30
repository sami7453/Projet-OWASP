<?php
class Router {
    private $routes = [];

    public function addRoute($action, $callback) {
        $this->routes[$action] = $callback;
    }

    public function route($action) {
        if (array_key_exists($action, $this->routes)) {
            call_user_func($this->routes[$action]);
        } else {
            
            header("HTTP/1.0 404 Not Found");
            echo "404 - Page non trouvée.";
        }
    }
}
?>
