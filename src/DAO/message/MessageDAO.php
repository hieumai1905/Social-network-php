<?php

namespace DAO\message;

use DAO\message\IMessageDAO;
use PDO;
use models\Conversations;
use models\Message;

require_once 'src/DAO/databases/ConnectDatabase.php';
require_once 'IMessageDAO.php';
require_once 'src/models/Message.php';

class MessageDAO implements IMessageDAO
{
    private $connection;
    public function __construct()
    {
        $this->connection = \DAO\Databases\ConnectDatabase::getConnection();
    }

    // public function getConversationByNameAndMgid($nameFrend, $curUserId){
    //     $stmt = $this->connection->prepare("SELECT * FROM conversations WHERE name = :name AND manager_id = :id ");
    //     $stmt->bindValue(':name', $nameFrend);
    //     $stmt->bindValue(':id', $curUserId);
    //     $stmt->execute();

    //     return $stmt->fetch(PDO::FETCH_OBJ);
    // }


    public function getMessageByIdConversation($id1, $id2)
    {

       
        $stmt = $this->connection->prepare('SELECT * FROM messages WHERE conversation_id = :id1 OR conversation_id = :id2 ORDER BY send_at ASC');
        $stmt->bindValue(':id1', $id1);
        $stmt->bindValue(':id2', $id2);
        $stmt->execute();




        // $stmt = $this->connection->prepare('SELECT * FROM messages WHERE conversation_id = :id ORDER BY send_at ASC');
        // $stmt->bindValue(':id', $conversationId);
        // $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);


    }

    


    public function create(Message $message)
    {
        // TODO: Implement createCommentForPost() method.
        $stmt = $this->connection->prepare("INSERT INTO messages (message_id ,send_at ,content, is_media, conversation_id, sender_id)
            VALUES (:id, :send_at, :content, 0, :conversation_id , :sender_id)");
        $stmt->bindValue(':content',$message->getContent());
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $stmt->bindValue(':send_at',date('d-M-y h:i:s A'));
        $stmt->bindValue(':conversation_id',$message->getConversationId());
        $stmt->bindValue(':id',uniqid());
        $stmt->bindValue(':sender_id',$message->getSenderId());
        $stmt->execute();
    }

    // public function updateComment(Comment $comment)
    // {
    //     // TODO: Implement updateComment() method.
    //     $stmt = $this->connection->prepare("UPDATE comments SET content = :content WHERE comment_id = :comment_id ");
    //     $stmt->bindValue(':content',$comment->getContent());
    //     $stmt->bindValue(':comment_id',$comment->getCommentId());
    //     $stmt->execute();
    // }

    // public function deleteComment($commentId)
    // {
    //     // TODO: Implement deleteComment() method.
    //     $stmt = $this->connection->prepare("DELETE FROM comments WHERE comment_id = :comment_id");
    //     $stmt->bindValue(':comment_id',$commentId);
    //     $stmt->execute();
    // }
}