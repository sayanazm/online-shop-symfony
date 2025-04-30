<?php

namespace App\Enum;

enum DeliveryType: string
{
    case Pickup = 'pickup';
    case Courier = 'courier';
}
