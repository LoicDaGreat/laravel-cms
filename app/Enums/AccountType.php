<?php

namespace App\Enums;

enum AccountType: string
{
    case CHECKING = 'checking';
    case SAVINGS = 'savings';
    case CREDIT = 'credit';
    case CASH = 'cash';
}
