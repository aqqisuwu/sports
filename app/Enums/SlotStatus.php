<?php

namespace App\Enums;

enum SlotStatus: string
{
    case Pending = 'pending';
    case Available = 'available';
    case Unavailable = 'uavailable';
}
