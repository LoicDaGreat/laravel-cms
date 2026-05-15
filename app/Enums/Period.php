<?php

namespace App\Enums;

enum Period: string
{
    case WEEKLY = 'weekly';
    case MONTHLY = 'monthly';
    case YEARLY = 'yearly';
}
