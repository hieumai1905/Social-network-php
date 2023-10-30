<?php

namespace services\user;

use models\User;
use services\IGeneralService;

require_once 'src/services/IGeneralService.php';

interface IUserService extends IGeneralService
{
    function loginAccount($email, $password): ?User;
    function registerAccount($full_name, $email, $password): ?User;
    function lockUser($userId): void;
    function getUserByEmail($email): ?User;
    function findUserByContent($content);
}