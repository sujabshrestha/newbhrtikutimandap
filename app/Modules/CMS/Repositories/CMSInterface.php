<?php

namespace CMS\Repositories;


interface CMSInterface
{
    public function submit($request);

    public function update($slug, $request);

}
