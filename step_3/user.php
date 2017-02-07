<?php
include_once("database.php");

class User {

  private $bdd;
  private $flag_name;
  private $flag_mail;
  private $flag_password;

  public function __construct()
  {
    $this->bdd = new Database();
    $this->bdd = $this->bdd->connect(); 
  }

  public function addUser($username, $email, $password)
  {
    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";

    $sth = $this->bdd->prepare($sql);
    $sth->bindParam(':username', $username, PDO::PARAM_STR);
    $sth->bindParam(':email', $email, PDO::PARAM_STR);
    $sth->bindParam(':password', $password, PDO::PARAM_STR);
    $sth->execute();
  }

  public function addUserAsAdmin($username, $email, $password, $admin)
  {
    $sql = "INSERT INTO users (username, email, password, admin) VALUES (:username, :email, :password, :admin)";

    $sth = $this->bdd->prepare($sql);
    $sth->bindParam(':username', $username, PDO::PARAM_STR);
    $sth->bindParam(':email', $email, PDO::PARAM_STR);
    $sth->bindParam(':password', $password, PDO::PARAM_STR);
    $sth->bindParam(':admin', $admin, PDO::PARAM_INT);
    $sth->execute();
  }

  public function loginUser($emailToCheck)
  {
    $sql = "SELECT email, password, username, admin FROM users WHERE email = :emailToCheck";
    $sth = $this->bdd->prepare($sql);
    $sth->bindParam(':emailToCheck', $emailToCheck, PDO::PARAM_STR);
    $sth->execute();

    return ($sth);

  }

  public function displayUser($emailToCheck)
  {
    $sql = "SELECT username, email, admin FROM users WHERE email = :emailToCheck";
    $sth = $this->bdd->prepare($sql);
    $sth->bindParam(':emailToCheck', $emailToCheck, PDO::PARAM_STR);
    $sth->execute();

    return ($sth);
  }

  public function editUser($userToEdit, $usernameToSet, $emailToSet, $passwordToSet, $adminToSet)
  {
    $sql = "UPDATE users SET username = :usernameToSet, email = :emailToSet, password = :passwordToSet, admin = :adminToSet WHERE email = :userToEdit";
    $sth = $this->bdd->prepare($sql);
    $sth->bindParam(':usernameToSet', $usernameToSet, PDO::PARAM_STR);
    $sth->bindParam(':emailToSet', $emailToSet, PDO::PARAM_STR);
    $sth->bindParam(':passwordToSet', $passwordToSet, PDO::PARAM_STR);
    $sth->bindParam(':adminToSet', $adminToSet, PDO::PARAM_INT);
    $sth->bindParam(':userToEdit', $userToEdit, PDO::PARAM_STR);
    $sth->execute();
  }

  public function deleteUser($userToDelete)
  {
    $sql = "DELETE FROM users WHERE email = :userToDelete";      
    $sth = $this->bdd->prepare($sql);
    $sth->bindParam(':userToDelete', $userToDelete, PDO::PARAM_STR);
    $sth->execute();
  }

  public function selectAllUsers()
  {
    $sql = "SELECT email FROM users ORDER BY email";
    $sth = $this->bdd->prepare($sql);
    $sth->execute();

    return ($sth);
  }

  public function checkUserName($name)
  {
      if (isset($name) && strlen($name) >= 3 && strlen($name) <= 10)
          {
              $this->flag_name = 1;
          }
      elseif (isset($name))
          {
            echo "Invalid name";
            echo "<br>";
            $this->flag_name = 0;
          }

    return $this->flag_name;
  }

  public function checkUserEmail($email, $user)
  {
      if (isset($email))
        {
          $sth = $user->loginUser($email);
        }


      if (isset($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && $sth->rowCount() == 0)
        {
          $this->flag_email = 1;
        }
      elseif (isset($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && $sth->rowCount() == 1)
        {
          echo "Email already exists, please choose another one";
          echo "<br>";
          $this->flag_email = 0;
        }
      elseif (isset($email))
        {
          echo "Invalid email";
          echo "<br>";
          $this->flag_email = 0;
        }

    return $this->flag_email;
  }

  public function checkUserPassword($password, $password_confirmation)
  {
      if (isset($password) && strlen($password) >= 3 && strlen($password) <= 10 && $password == $password_confirmation)
        {
          $this->flag_password = 1;
        }
      elseif (isset($password))
        {
          echo "Invalid password or password confirmation";
          echo "<br>";
          $this->flag_password = 0;
        }
    return $this->flag_password;
  }

  public function checkUserEmailForEditOnly($email)
  {
      if (isset($email) && filter_var($email, FILTER_VALIDATE_EMAIL))
        {
          $this->flag_email = 1;
        }
      elseif (isset($email))
        {
          echo "Invalid email";
          echo "<br>";
          $this->flag_email = 0;
        }

    return $this->flag_email;
  }

}

 ?>
