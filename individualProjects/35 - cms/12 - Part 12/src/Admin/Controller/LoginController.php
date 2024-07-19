<?php

namespace App\Admin\Controller;

use App\Admin\Support\AuthService;

class LoginController extends AbstractAdminController {

    public function logout() {
        $this->authService->logout();
        header('Location: index.php?' . http_build_query(['route' => 'admin/login']));
    }

    public function login() {
        if ($this->authService->isLoggedIn()) {
            header('Location: index.php?' . http_build_query(['route' => 'admin/pages']));
            return;
        }
        
        // var_dump("LoginController::login() has been called!");
        $loginError = false;
        if (!empty($_POST)) {
            $username = @(string) ($_POST['username'] ?? '');
            $password = @(string) ($_POST['password'] ?? '');

            if (!empty($username) && !empty($password)) {
                $loginOk = $this->authService->handleLogin($username, $password);
                if ($loginOk === true) {
                    header('Location: index.php?' . http_build_query(['route' => 'admin/pages']));
                    return;
                }
                else {
                    $loginError = true;
                }
            }
            else {
                $loginError = true;
            }
            
        }
        $this->render('login/login', [
            'loginError' => $loginError
        ]);
    }
}