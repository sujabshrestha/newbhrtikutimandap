<?php

namespace User\Repositories\User;


interface UserInterface
{
    public function store($request);

    public function update($request);

    public function getById($id);

    public function trashedDestroy($id);

    public function trashedRecover($id);

    public function getUserByAuth();

    public function changeUserPassword($request);

    public function changeUserPasswordSubmit($request);

    public function userProfileSubmit($request);


   

}
