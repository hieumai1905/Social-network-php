<?php

namespace DAO\user;

use PDO;
use models\User;

require_once 'src/DAO/databases/ConnectDatabase.php';
require_once 'IUserDAO.php';
require_once 'src/models/User.php';

class UserDAO implements IUserDAO
{

    private $connection;

    public function __construct()
    {
        $this->connection = \DAO\Databases\ConnectDatabase::getConnection();
    }

    public function getUserById($id)
    {
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE user_id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getAllUsers(): ?array
    {
        $stmt = $this->connection->query('SELECT * FROM users');
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function createUser(User $user)
    {
        $stmt = $this->connection->prepare('INSERT INTO users (user_id, full_name, email, password, user_role, status, cover_image, avatar, register_at)
                                VALUES (:id, :name, :email, :password, :role, :status,:cover,:avatar, :register_at)');
        $stmt->bindValue(':id', $user->getUserId());
        $stmt->bindValue(':name', $user->getFullName());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':role', $user->getUserRole());
        $stmt->bindValue(':status', $user->getStatus());
        $stmt->bindValue(':cover', $user->getCoverImage());
        $stmt->bindValue(':avatar', $user->getAvatar());
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $stmt->bindValue(':register_at',date('d-M-y h:i:s A'));
        $stmt->execute();
    }

    public function updateUser(User $user)
    {
        $stmt = $this->connection->prepare('UPDATE users SET full_name = :name, email = :email, password = :password, avatar = :avatar, cover_image = :cover,  
             dob=:dob, address=:address, gender=:gender, phone=:phone, status=:status, user_role=:role, about_me=:about WHERE user_id = :id');
        $stmt->bindValue(':id', $user->getUserId());
        $stmt->bindValue(':name', $user->getFullName());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':avatar', $user->getAvatar());
        $stmt->bindValue(':cover', $user->getCoverImage());
        $stmt->bindValue(':dob', $user->getDob());
        $stmt->bindValue(':address', $user->getAddress());
        $stmt->bindValue(':gender', $user->getGender());
        $stmt->bindValue(':phone', $user->getPhone());
        $stmt->bindValue(':status', $user->getStatus());
        $stmt->bindValue(':role', $user->getUserRole());
        $stmt->bindValue(':about', $user->getAboutMe());
        $stmt->execute();
    }

    public
    function deleteUser($id)
    {
        $stmt = $this->connection->prepare('DELETE FROM users WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public
    function getUserByEmail($email)
    {
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getUserByNameOrEmailOrPhone($content)
    {
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE upper(full_name) like :content or upper(email) like :content or phone like :content');
        $stmt->bindValue(':content', '%' . mb_strtoupper($content) . '%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getNewUserInMonth()
    {
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE MONTH(register_at) = MONTH(CURRENT_DATE()) AND YEAR(register_at) = YEAR(CURRENT_DATE())');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}