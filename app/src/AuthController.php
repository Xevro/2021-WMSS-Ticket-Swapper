<?php

class AuthController {
    protected \Doctrine\DBAL\Connection $db;
    protected \Twig\Environment $twig;

    public function __construct() {
        // bootstrap Twig
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../resources/templates');
        $this->twig = new \Twig\Environment($loader);
        //Database connection
        $this->db = getDBConnection();
    }

    public function showLogin() {
        if (isset($_SESSION['user'])) {
            header('location: /');
            exit();
        }
        //View
        echo $this->twig->render('pages/login.twig', ['firstName' => isset($_SESSION['user']['first_name']), 'email' => (string)isset($_COOKIE['email']) ? $_COOKIE['email'] : '']);
    }

    public function login() {
        $formErrors = [];
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $remember = isset($_POST['remember']) ? $_POST['remember'] : false;

        if (isset($_POST['moduleAction']) && ($_POST['moduleAction'] == 'login')) {
            // Get user with sent username from DB
            $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?;');
            $stmt->execute([$email]);
            $user = $stmt->fetchAssociative();

            // User found
            if ($user !== false) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;
                    if ($remember) {
                        setcookie('email', $_SESSION['user']['email'], time() + 24 * 60 * 60 * 7);
                    }
                    header('location: /');
                    exit();
                } else { // Invalid login
                    $formErrors['login'] = 'There might something wrong with your e-mailadress and/or password';
                }
            } // username & password are not valid
            else {
                $formErrors['login'] = 'There might something wrong with your e-mailadress and/or password';
            }
        }
        //View
        echo $this->twig->render('pages/login.twig', ['firstName' => isset($_SESSION['user']['first_name']), 'formErrors' => $formErrors]);
    }

    public function showRegister() {
        echo $this->twig->render('pages/register-account.twig');
    }

    public function register() {
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
        $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
        $address = isset($_POST['address']) ? trim($_POST['address']) : '';
        $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';
        $invitecode = isset($_POST['invitecode']) ? trim($_POST['invitecode']) : '';
        $formErrors = [];

        if (isset($_POST['moduleAction']) && ($_POST['moduleAction'] == 'register')) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($password == $confirm_password) {
                    $stmt = $this->db->prepare('INSERT INTO users SET first_name = ?, last_name = ?, address = ?, couponcode = ?, email = ?, password = ?');
                    $stmt->execute([$firstname, $lastname, $address, generateRandomString(10), $email, password_hash($password, PASSWORD_DEFAULT)]);
                    $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
                    $stmt->execute([$email]);
                    $user = $stmt->fetchAssociative();

                    $stmt = $this->db->prepare('UPDATE users SET invite_number = invite_number + 1 WHERE couponcode = ?');
                    $stmt->execute([$invitecode]);

                    $_SESSION['user'] = $user;
                    header('location: /');
                    exit();
                } else {
                    $formErrors['register'] = 'Invalid login credentials';
                }
            } else {
                $formErrors['register'] = 'Not a valid e-mail address';
            }
        }
        //View
        echo $this->twig->render('pages/register-account.twig', ['firstName' => isset($_SESSION['user']['first_name']), 'formErrors' => $formErrors]);
    }

    public function logout() {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header('location: login');
        exit();
    }
}