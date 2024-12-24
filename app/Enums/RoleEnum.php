<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN      = 'admin';
    case INSTRUCTOR = 'instructor';
    case STUDENT    = 'student';
}