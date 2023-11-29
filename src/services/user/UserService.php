<?php

namespace services\user;

use DAO\user\IUserDAO;
use services\handle\Encryption;
use storage\Logger;
use models\User;
use storage\Mapper;


require_once 'IUserService.php';
require_once 'src/storage/Logger.php';
require_once 'src/storage/Mapper.php';
require_once 'src/models/User.php';
require_once 'src/services/handle/Encryption.php';


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
        try {
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
            if ($data) {
                Logger::log('Get user by email successfully');
                if (Encryption::encrypt($password) == $data->PASSWORD) {
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
                $userRegister->setPassword(Encryption::encrypt($password));
                $userRegister->setUserRole('USER');
                $userRegister->setStatus('INACTIVE');
                $userRegister->setAvatar('avatar.jpg');
                $userRegister->setCoverImage('cover.jpg');
                $this->userDAO->createUser($userRegister);
                $userRegister = $this->userDAO->getUserByEmail($email);
                $userRegister = Mapper::mapStdClassToModel($userRegister, User::class);
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

    function getUserByEmail($email): ?User
    {
        try {
            $data = $this->userDAO->getUserByEmail($email);
            if ($data) {
                Logger::log('Get user by email successfully User id: ' . $data->USER_ID);
                return Mapper::mapStdClassToModel($data, User::class);
            }
            Logger::log('Get user by email failed');
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
    function lockUser($userId): void
    {
        try {
            $message = '';
            $user = $this->userDAO->getUserById($userId);
            if ($user) {
                if ($user->status == 'ACTIVE') {
                    $user->status = 'LOCK';
                    $message = 'Lock user successfully';
                } else if ($user->status == 'INACTIVE') {
                    $user->status = 'ACTIVE';
                    $message = 'Unlock user successfully';
                }
                $user = Mapper::mapStdClassToModel($user, User::class);
                $this->userDAO->updateUser($user);
                Logger::log($message . ' - User id: ' . $user->getUserId());
            } else {
                Logger::log('Lock user failed');
            }
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function findUserByContent($content)
    {
        try {
            $data = $this->userDAO->getUserByNameOrEmailOrPhone(urldecode($content));
            if (!$data) {
                Logger::log('Get user by email failed');
                return null;
            }
            $users = [];
            foreach ($data as $item) {
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

    function getNewUserInMonth()
    {
        try {
            $result = $this->userDAO->getNewUserInMonth();
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

    function updateAvatar($image)
    {
        try {
            $userLogin = unserialize($_SESSION['user-login']);
            $userLogin->setAvatar($image);
            $_SESSION['user-login'] = serialize($userLogin);
            $this->userDAO->updateUser($userLogin);
            Logger::log('Change avatar successfully');
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function updateCoverImage($image)
    {
        try {
            $userLogin = unserialize($_SESSION['user-login']);
            $userLogin->setCoverImage($image);
            $this->userDAO->updateUser($userLogin);
            Logger::log('Change cover image successfully');
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}