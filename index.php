
<?php

// index.php (Routeur principal)

session_start();

require_once 'config/database.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/PrestationController.php';
require_once 'models/User.php';
require_once 'models/UserManager.php';
require_once 'models/Prestation.php';
require_once 'models/PrestationManager.php';
require_once 'models/Tarif.php';
require_once 'models/TarifManager.php';
require_once 'models/Droits.php';
require_once 'models/DroitsManager.php';
require_once 'models/Categorie.php';
require_once 'models/CategorieManager.php';

// Déterminer la route
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        require 'views/home.php';
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'register':
        $controller = new AuthController();
        $controller->register();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'prestations':
        $controller = new PrestationController();
        $controller->index();
        break;
    case 'admin':
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
            require 'admin/index.php';
        } else {
            header('Location: index.php');
            exit;
        }
        break;
    default:
        require 'views/404.php';
        break;
}

// controllers/AuthController.php
class AuthController
{
    public function login()
    {
        require 'views/login.php';
    }

    public function register()
    {
        require 'views/register.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}

// controllers/PrestationController.php
class PrestationController
{
    public function index()
    {
        require 'views/prestations.php';
    }
}

// models/User.php
class User
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $role;
}

// models/UserManager.php
class UserManager
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function createUser($name, $email, $password, $role)
    {
        $stmt = $this->db->prepare("INSERT INTO utilisateurs (name, email, password, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, password_hash($password, PASSWORD_BCRYPT), $role]);
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

// models/Prestation.php
class Prestation
{
    public $id;
    public $name;
    public $price;
}

// models/PrestationManager.php
class PrestationManager
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function getAllPrestations()
    {
        $stmt = $this->db->query("SELECT * FROM prestations");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// models/Tarif.php
class Tarif
{
    public $id;
    public $categorie_id;
    public $prestation_id;
    public $price;
}

// models/TarifManager.php
class TarifManager
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function getTarifsByCategorie($categorie_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tarifs WHERE categorie_id = ?");
        $stmt->execute([$categorie_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// models/Droits.php
class Droits
{
    public $id;
    public $name;
}

// models/DroitsManager.php
class DroitsManager
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }
}

// models/Categorie.php
class Categorie
{
    public $id;
    public $name;
}

// models/CategorieManager.php
class CategorieManager
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function getAllCategories()
    {
        $stmt = $this->db->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}







