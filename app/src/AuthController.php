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

        $errorEmail = '';
        $errorPassword = '';
        $errorFirstName = '';
        $errorLastName = '';
        $errorAddress ='';
        $errorConfirm ='';
        $errorInviteCode ='';

        if (isset($_POST['btnRegister'])) {
            $allOk = true;

            if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
                $errorEmail = 'A valid email is required!';
                $allOk = false;
            }
            if ($password === '') {
                $errorPassword = 'A valid first password is required!';
                $allOk = false;
            }
            if ($confirm_password === '') {
                $errorConfirm = 'this is not the same as your password';
                $allOk = false;
            }
            if ($firstname === '') {
                $errorFirstName = 'A valid firstname is required!';
                $allOk = false;
            }
            if ($lastname === '') {
                $errorLastName = 'A valid lastname is required!';
                $allOk = false;
            }
            if ($address === '') {
                $errorAddress = 'A valid address is required!';
                $allOk = false;
            }
            if ($invitecode === '') {
                $errorInviteCode = 'A valid invitecode is required!';
                $allOk = false;
            }
            if ($allOk && $password == $confirm_password) {
                //add to database
                $stmt = $this->db->prepare('INSERT INTO users SET first_name = ?, last_name = ?, address = ?, invitecode = ?, email = ?, password = ?');
                $stmt->execute([$firstname, $lastname, $address, generateRandomString(10), $email, password_hash($password, PASSWORD_DEFAULT)]);
                $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
                $stmt->execute([$email]);
                $user = $stmt->fetchAssociative();

                $stmt = $this->db->prepare('UPDATE users SET invite_number = invite_number + 1 WHERE invitecode = ?');
                $stmt->execute([$invitecode]);

                $_SESSION['user'] = $user;
                header('location: /');
                exit();
            }
        }

        //View
        echo $this->twig->render('pages/register-account.twig', [
            'firstName' => isset($_SESSION['user']['first_name']),'lastName' => isset($_SESSION['user']['last_name']),
            'firstname' => $firstname,'lastname' => $lastname,'email' => $email, 'password' => $password, 'address' => $address, 'invitecode' => $invitecode,
            'errorEmail' => $errorEmail,'errorPassword' => $errorPassword,'errorFirstName' => $errorFirstName,'errorLastName' => $errorLastName,'errorAddress' => $errorAddress,'errorConfirm' => $errorConfirm,'errorInviteCode' => $errorInviteCode]);
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