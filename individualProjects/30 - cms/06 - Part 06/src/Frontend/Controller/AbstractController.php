<?php

namespace App\Frontend\Controller;

abstract class AbstractController {
    protected function render($view, $params) {
        extract($params);
    
        ob_start();
        require __DIR__ . '/../../../views/frontend/' . $view . '.view.php';
        $contents = ob_get_clean();
         
        require __DIR__ . '/../../../views/frontend/layouts/main.view.php';
    }

    protected function error404() {
        http_response_code(404);
        
        $this->render('abstract/error404', []);
    }
}