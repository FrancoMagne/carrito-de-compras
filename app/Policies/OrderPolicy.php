<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function author(User $user, Order $order) {
        if($order->user_id == $user->id) {
            return true;
        }
        return false;
    }

    public function payment(User $user, Order $order) {
        if($order->status == 1) {
            return true;
        }
        return false;
    }
}
