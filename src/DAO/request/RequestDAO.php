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
        $stmt = $this->connection->prepare("DELETE FROM requests WHERE request_at < (TO_TIMESTAMP(:request_at, 'DD-MON-YY HH:MI:SS AM') - NUMTODSINTERVAL(1, 'MINUTE'))");
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $requestAt = date('d-M-y h:i:s A');
        $stmt->bindParam(':request_at', $requestAt, PDO::PARAM_STR, 23);
        $stmt->execute();
    }

    public function addRequest(Request $request)
    {
        $stmt = $this->connection->prepare("INSERT INTO requests (request_at,email_request, type_request, request_code) VALUES (:request_at,:email, :type, :code)");
        $stmt->bindValue(':email', $request->getEmailRequest());
        $stmt->bindValue(':type', $request->getTypeRequest());
        $stmt->bindValue(':code', $request->getRequestCode());
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $stmt->bindValue(':request_at',date('d-M-y h:i:s A'));
        $stmt->execute();
    }

    public function updateRequest(Request $request)
    {
        $stmt = $this->connection->prepare("UPDATE requests SET request_code = :code, type_request=:type, request_at = :request_at WHERE request_id = :id");
        $stmt->bindValue(':id', $request->getRequestId());
        $stmt->bindValue(':code', $request->getRequestCode());
        $stmt->bindValue(':type', $request->getTypeRequest());
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $stmt->bindValue(':request_at',date('d-M-y h:i:s A'));
        $stmt->execute();
    }

    public function deleteRequest($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM requests WHERE request_id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}