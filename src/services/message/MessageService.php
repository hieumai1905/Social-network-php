<?php

namespace services\message;

use DAO\message\MessageDAO;
use models\Message;
use storage\Logger;
use storage\Mapper;

require_once 'IMessageService.php';
class MessageService implements IMessageService
{
    private $messageDAO;

    public function __construct(MessageDAO $messageDAO)
    {
        $this->messageDAO = $messageDAO;
    }

    public function getByConId($conId, $conIdtarget)
    {
        try {
            $result = $this->messageDAO->getMessageByIdConversation($conId, $conIdtarget);
            if (!$result)
                return null;
            $msg = []; // Đổi tên biến $msg thành $messages để tránh xung đột với biến $msg bên trong vòng lặp.

            foreach ($result as $item) {
                $message = Mapper::mapStdClassToModel($item, Message::class); // Đổi tên biến $msg thành $message ở đây.
                $msg[] = $message; // Sử dụng mảng $messages để lưu trữ các thông điệp.
            }

            return $msg; // Trả về mảng $messages.

        } catch (\Exception $e) {
            //throw $th;
            throw new \Exception($e->getMessage());
        }
    }

    public function createMess($userId, $content, $conversattion){
        try {
            $message = new Message();
            $message->setSenderId($userId);
            $message->setContent($content);
            $message->setConversationId($conversattion);

            $this->messageDAO->create($message);

            return true;
        } catch (\Exception $e) {
            
            throw new \Exception($e->getMessage());
        }
    }
}