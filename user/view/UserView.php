<?php


namespace user\view;
use user\model\UserModel;

class UserView {

  protected UserModel|null $user;
  public function __construct() {
  }

  /**
   * Sets user property.
   *
   * @param UserModel $user
   *   User model.
   *
   */
  public function setUser(UserModel $user) {
    $this->user = $user;
  }

  /**
   * Getter for displayName.
   *
   * @return string
   */
  public function getDisplayName() {
    return $this->user?->get('username') ?? '';
  }

  /**
   * Getter for email.
   *
   * @return string
   */
  public function getEmail() {
    return $this->user?->get('email') ?? '';
  }


  public function buildRegistrationForm() {
    return
      '<section class="registration form">
        <h1>Registration</h1>
        <form action="/register" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <br>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <input type="submit" name="register" value="Register">
        </form>
      </section>';
  }

  public function buildLoginForm() {
    return '<section class="login form">
        <h1>Login</h1>
        <form action="/login" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <input type="submit" name="login" value="Login">
        </form>
    </section>
    ';
  }

  

}
