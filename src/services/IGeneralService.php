<?php

namespace services;

interface IGeneralService
{
    function getAll(): ?array;

    function getById($id): ?object;

    function add($object);

    function update($object);

    function delete($id);

}