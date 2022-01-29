<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\DataTransferObject\DataTransferObject;

class DTO extends DataTransferObject
{
    //** @var int */
    public $httpCode;

    //** @var string */
    public $httpMessage;

    //** @var int */
    public $numberOfResults;

    //** @var object[] */
    public $data;
}
