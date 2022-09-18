<?php

namespace App\Repositories\Api\Shelving;

interface ShelvingInterface
{
    public function postShelving($request);
    public function postBoxList($request);
}
