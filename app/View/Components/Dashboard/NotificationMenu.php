<?php

namespace App\View\Components\Dashboard;

use App\Models\Order;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationMenu extends Component
{
    /**
     * Create a new component instance.
     */

    public $notification;
    public $NewCount;

    public function __construct($count)
    {
        $user = Auth::user();

        $this->notification = $user->notifications()->take($count)->get();

        $this->NewCount = $user->unreadNotifications->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.notification-menu',[
            'notifications' => $this->notification,
            'newCount' => $this->NewCount,
        ]);
    }
}
