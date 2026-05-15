<?php

namespace App\Enums;

enum Status: int
{
    case ACTIVE = 1;
    case COMPLETED = 2;
    case PAUSED = 3;
}
