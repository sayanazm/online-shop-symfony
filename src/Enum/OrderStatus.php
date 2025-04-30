<?php

namespace App\Enum;

enum OrderStatus: string
{
    case Paid = 'paid';
    case Assembling = 'assembling';
    case Ready = 'ready';
    case Delivered = 'delivered';
    case Cancelled = 'cancelled';
}