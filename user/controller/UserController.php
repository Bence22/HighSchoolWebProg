<?php

namespace user\controller;
use base\controller\BaseController;
use user\model\UserModel;
use user\view\UserView;

class UserController extends BaseController {

  protected UserModel $user;
  protected UserView $view;

  public function __construct() {
    $this->user = new UserModel();
    $this->view = new UserView();
    $this->view->setUser($this->user);
    $this->content = '';
  }

  public function handle() {
    $action = $_GET['action'] ?? '';
    if (empty($action)) {
      return;
    }
    if ($action === 'login') {
      $this->handleLogin();
    }
    elseif ($action === 'register') {
      $this->handleRegistration();
    }
    elseif ($action === 'logout') {
      $this->handleLogout();
    }
    else {
      $this->redirect('/login');
    }
  }

  public function handleLogin() {
    if (isset($_SESSION[SESSION_USER_LOGGED_IN])) {
      $this->redirect('/');
    }
    if (!isset($_POST['login'])) {
      $this->content = $this->view->buildLoginForm();
    }
    else {
      $username = $_POST['username'] ?? '';
      $password = $_POST['password'] ?? '';
      $authenticated = $this->user->authenticate($username, $password);
      if ($authenticated) {
        $this->redirect('/');
      } else {
        $this->redirect('/login?error' . $this::WRONG_CREDENTIALS_ERROR);
      }
    }
  }

  public function handleRegistration() {
    if (isset($_SESSION[SESSION_USER_LOGGED_IN])) {
      $this->redirect('/');
    }
    if (!isset($_POST['register'])) {
      $this->content = $this->view->buildRegistrationForm();
    } else {
      $email = $_POST['email'] ?? '';
      $username = $_POST['username'] ?? '';
      $password = $_POST['password'] ?? '';
      $registered = $this->user->register($email, $username, $password);

      if ($registered) {
        $this->redirect('/login');
      } else {
        $this->redirect('/register?error=' . $this::EMAIL_IN_USE_ERROR);
      }
    }
  }

  public function handleLogout() {
    $this->content = '';
    unset($_SESSION[SESSION_CURRENT_USER_ID]);
    unset($_SESSION[SESSION_USER_LOGGED_IN]);
    session_destroy();
    $this->redirect('/');
  }

  public function index() {
    $this->content = '';
  }

}
