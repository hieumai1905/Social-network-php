<?php

namespace DAO\request;
use models\Request;
require_once 'src/models/Request.php';
interface IRequestDAO
{
    public function getRequestByEmail($email);
    public function cleanRequestCode();
    public function addRequest(Request $request);

    public function updateRequest(Request $request);

    public function deleteRequest($id);
}