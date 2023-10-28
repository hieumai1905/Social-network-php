<?php

namespace services\request;

use DAO\request\IRequestDAO;
use models\Request;
use storage\Logger;
use storage\Mapper;

require_once 'IRequestService.php';
require_once 'src/storage/Logger.php';
require_once 'src/storage/Mapper.php';
require_once 'src/models/Request.php';

class RequestService implements IRequestService
{

    private $requestDAO;

    public function __construct(IRequestDAO $requestDAO)
    {
        $this->requestDAO = $requestDAO;
    }

    function getAll(): ?array
    {
        // TODO: Implement getAll() method.
    }

    function getById($id): ?object
    {
        // TODO: Implement getById() method.
    }

    /**
     * @throws \Exception
     */
    function add($object)
    {
        try{
            $this->requestDAO->addRequest($object);
            Logger::log('Add request successfully');
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
    function update($object)
    {
        try{
            $this->requestDAO->updateRequest($object);
            Logger::log('Update request successfully');
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
        try{
            $this->requestDAO->deleteRequest($id);
            Logger::log('Delete request successfully');
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
    public function getRequestByEmail($email): ?Request
    {
        try{
            $result = $this->requestDAO->getRequestByEmail($email);
            Logger::log('Get request by email successfully');
            if(!$result){
                Logger::log('No request found');
                return null;
            }
            return Mapper::mapStdClassToModel($result, Request::class);
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
    public function cleanRequestCode()
    {
        try{
            $this->requestDAO->cleanRequestCode();
            Logger::log('Clean request code successfully');
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
    public function refreshCode($email, $code)
    {
        try{
            $request = $this->getRequestByEmail($email);
            if($request){
                $request->setRequestCode($code);
                $this->requestDAO->updateRequest($request);
                Logger::log('Refresh code successfully');
            }
            else{
                Logger::log("Request don't exist");
                throw new \Exception("Request don't exist");
            }
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}