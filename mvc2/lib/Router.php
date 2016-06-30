<?php

class Router {
    const DEFAULT_CONTROLLER = 'index';
    const DEFAULT_ACTION = 'index';

    public static function run() {
        $url = $_SERVER['REQUEST_URI']; // Читаємо URL

        $route = array('controller' => Router::DEFAULT_CONTROLLER, 'action' => Router::DEFAULT_ACTION); // Визначаємо акцію і контролер за замовчуванням

        // Парсуємо і визначаємо акцію і контролер за такою схемою mysite.com/controller_name/action_name
        $url = explode('/', $url);
        $url = array_filter($url);

        if (count($url) > 1) {
            $route['controller'] = $url[1];
            $route['action'] = $url[2];
        } else if (count($url) > 0) $route['controller'] = $url[1];

        // Визначаємо файл де є наш контроллер
        $controllerClass = $route['controller'] . 'Controller';
        $controllerPath = APPLICATION_PATH . '/controllers/' . $controllerClass . '.php';

        if (!is_file($controllerPath)) throw new Exception("No such controller!");

        require $controllerPath;

        if (!class_exists($controllerClass)) throw new Exception("No class has been found!");

        // Створюємо об'єкт контролера
        $controllerObject = new $controllerClass();
        $actionName = $route['action'] . 'Action'; // Визначаємо назву акції - функції у класі, за конвенцією "назваакціїїAction"

        if (!method_exists($controllerObject, $actionName)) throw new Exception("No action!");

        $controllerObject->$actionName(); // Викликаємо акцію.
    }
}