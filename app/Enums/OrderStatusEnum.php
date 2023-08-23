<?php
namespace App\Enums;

enum OrderStatusEnum: string{
    case Pending = 'pending';
    case Processing = 'processing';
    case Completed = 'completed';
    case Declined = 'declined';
}
