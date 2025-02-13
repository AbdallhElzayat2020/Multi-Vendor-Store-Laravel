<?php

namespace App\View\Components\Dashboard;

use App\Models\Order;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NotificationMenu extends Component
{
    /**
     * Create a new component instance.
     */

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.notification-menu');
    }
}
