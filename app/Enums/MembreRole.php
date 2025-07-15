<?php

namespace App\Enums;

enum MembreRole: string
{
    case MANAGER = 'manager';
    case DEVELOPER = 'developer';
    case DESIGNER = 'designer';
    case TESTER = 'tester';
}
