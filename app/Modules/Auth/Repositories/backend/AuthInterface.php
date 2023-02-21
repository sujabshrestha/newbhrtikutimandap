<?php

namespace Auth\Repositories\backend;


interface AuthInterface
{
    public function loginSubmit($request);

    public function registerSubmit($request);

}
