<?php

namespace DAO\request;
use models\Request;
require_once 'src/models/Request.php';
interface IRequestDAO
{
    public function getUserById($id);

    public function getAllUsers(): ?array;

    public function createUser(User $user);

    public function updateUser(User $user);

    public function deleteUser($id);

    public function getUserByEmail($email);
}