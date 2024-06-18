<?php

namespace App\Enums;

enum Role: string
{
    case Admin = "Admin";
    case Kasir = "Kasir";
    case ShopEmployee = "ShopEmployee";
}

