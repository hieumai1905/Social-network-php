<?php

namespace DAO\request;

use models\Request;
use PDO;

require_once 'src/DAO/databases/ConnectDatabase.php';
require_once 'IRequestDAO.php';
require_once 'src/models/Request.php';

class RequestDAO implements IRequestDAO
{


    private $connection;

    public function __construct()
    {
        $this->connection = \DAO\Databases\ConnectDatabase::getConnection();
    }

    public function getRequestByEmail($email)
    {
        $stmt = $this->connection->prepare("SELECT * FROM requests WHERE email_request = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function cleanRequestCode()
    {
        $stmt = $this->connection->prepare("DELETE FROM requests WHERE request_at < (NOW() - INTERVAL 1 MINUTE);");
        $stmt->execute();
    }

    public function addRequest(Request $request)
    {
        $stmt = $this->connection->prepare("INSERT INTO requests (email_request, type_request, request_code, request_at) VALUES (:email, :type, :code, NOW())");
        $stmt->bindValue(':email', $request->getEmailRequest());
        $stmt->bindValue(':type', $request->getTypeRequest());
        $stmt->bindValue(':code', $request->getRequestCode());
        $stmt->execute();
    }

    public function updateRequest(Request $request)
    {
        $stmt = $this->connection->prepare("UPDATE requests SET request_code = :code, type_request=:type, request_at = NOW() WHERE request_id = :id");
        $stmt->bindValue(':id', $request->getRequestId());
        $stmt->bindValue(':code', $request->getRequestCode());
        $stmt->bindValue(':type', $request->getTypeRequest());
        $stmt->execute();
    }

    public function deleteRequest($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM requests WHERE request_id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}