<?php

namespace services\notification;

use DAO\notification\INotificationDAO;
use models\Notification;
use services\IGeneralService;
use storage\Logger;
use storage\Mapper;
require_once 'INotificationService.php';
require_once 'src/storage/Logger.php';
require_once 'src/storage/Mapper.php';
require_once 'src/models/Notification.php';

class NotificationService implements INotificationService {
    private $notificationDAO;
    public function __construct(INotificationDAO $notificationDAO)
    {
        $this->notificationDAO = $notificationDAO;
    }

    function getAll(): ?array
    {
        return 0;
    }

    function getById($id): ?object
    {
        return 0;
    }

    function add($object)
    {
        // TODO: Implement add() method.
    }

    function update($object)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function addNotificationWhenSendFriendRequest(Notification $notification)
    {
        try {
            $this->notificationDAO->addNotification($notification);
            Logger::log("Add notification successfully");
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        }catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

        public function getNotificationByUserRecipient($user_recipient)
    {
        try {
            $result = $this->notificationDAO->getNotificationByUserRecipient($user_recipient);
            Logger::log("Get notification successfully");
            if (!$result) {
                Logger::log('No notification found');
                return null;
            }
            $notifications = [];
            foreach ($result as $item) {
                $notification = Mapper::mapStdClassToModel($item,Notification::class);
                $notifications[] = $notification;
            }
            return $notifications;
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        }catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}
