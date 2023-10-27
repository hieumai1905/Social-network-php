<?php

namespace services\user;

use DAO\user\IUserDAO;
use services\mail\Mailer;
use storage\Logger;
use models\User;
use storage\Mapper;


require_once 'IUserService.php';
require_once 'src/storage/Logger.php';
require_once 'src/storage/Mapper.php';
require_once 'src/models/User.php';
require_once 'src/services/mail/Mailer.php';


class UserService implements IUserService
{
    private $userDAO;

    public function __construct(IUserDAO $userDAO)
    {
        $this->userDAO = $userDAO;
    }

    /**
     * @throws \Exception
     */
    function getById($id): ?object
    {
        try{
            $result = $this->userDAO->getUserById($id);
            Logger::log('Get user by id successfully');
            if (!$result) {
                Logger::log('No user found');
                return null;
            }
            return Mapper::mapStdClassToModel($result, User::class);
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function add($object)
    {
        // TODO: Implement add() method.
    }

    function update($object)
    {
        try {
            $this->userDAO->updateUser($object);
            Logger::log('Update user successfully');
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    function delete($id)
    {
        try {
            $this->userDAO->deleteUser($id);
            Logger::log('Delete user successfully');
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    function getAll(): ?array
    {
        try {
            $result = $this->userDAO->getAllUsers();
            Logger::log('Get all users successfully');
            if (count($result) == 0) {
                Logger::log('No user found');
                return null;
            }
            $users = [];
            foreach ($result as $item) {
                $user = Mapper::mapStdClassToModel($item, User::class);
                $users[] = $user;
            }
            return $users;
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    function loginAccount($email, $password): ?User
    {
        try {
            $data = $this->userDAO->getUserByEmail($email);
            Logger::log('Get user by email successfully');
            if ($data) {
                if ($password == $data->password) {
                    Logger::log('Login successfully User id: ' . $data->user_id);
                    return Mapper::mapStdClassToModel($data, User::class);
                }
            }
            Logger::log('Login failed');
            return null;
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    function registerAccount($full_name, $email, $password): ?User
    {
        try {
            $data = $this->userDAO->getUserByEmail($email);
            Logger::log('Get user by email successfully');
            if (!$data) {
                $userRegister = new User();
                $userRegister->setUserId(uniqid());
                $userRegister->setFullName($full_name);
                $userRegister->setEmail($email);
                $userRegister->setPassword($password);
                $userRegister->setUserRole('USER');
                $userRegister->setStatus('ACTIVE');
                $userRegister->setAvatar('avatar.jpg');
                $userRegister->setCoverImage('cover.jpg');
                $this->userDAO->createUser($userRegister);
                $userRegister = $this->userDAO->getUserByEmail($email);
                if (!$userRegister) {
                    Logger::log('Create user failed');
                }
                Logger::log('Create user successfully - User id: ' . $userRegister->getUserId());
                return $userRegister;
            }
            throw new \Exception('Email already exists');
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}