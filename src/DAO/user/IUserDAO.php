<?php

namespace DAO\user;
use models\User;
require_once 'src/models/User.php';
interface IUserDAO
{
    public function getUserById($id);

    public function getAllUsers(): ?array;

    public function createUser(User $user);

    public function updateUser(User $user);

    public function deleteUser($id);

    public function getUserByEmail($email);

    public function getUserByNameOrEmailOrPhone($content);

    public function getNewUserInMonth();
}