<?php

namespace App\Enums;

enum TokenAbility: string
{
    case ACCESS_TOKEN = 'access';
    case REFRESH_TOKEN = 'refresh';
}
