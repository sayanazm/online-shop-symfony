<?php

namespace App\Order\Enum;

enum DeliveryType: string
{
    case Pickup = 'pickup';
    case Courier = 'courier';
}
