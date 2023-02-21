<?php

namespace Auth\Repositories\vendor;


interface AuthVendorInterface
{
    public function loginSubmit($request, $fieldType, $field);

    public function registerSubmit($request);

}
