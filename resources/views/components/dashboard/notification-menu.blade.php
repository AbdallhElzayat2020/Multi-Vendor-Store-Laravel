<li class="nav-item dropdown">

    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        @if($NewCount)
            <span class="badge bg-primary badge-number">{{$NewCount}}</span>
        @endif
    </a>
    <!-- End Notification Icon -->

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
            You have {{$NewCount}} new notifications
            <a href="javascript:void(0)"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
        </li>
        @foreach($notifications as $notification)

            <li>
                <hr class="dropdown-divider">
            </li>

            <li class="notification-item @if($notification->unread()) fw-bold @endif">
                <i class="{{$notification->data['icon']}}"></i>
                <a href="{{$notification->data['url']}}?notification_id={{$notification->id}}">
                    <div>
                        <p>{{$notification->data['body']}}</p>
                        <p>{{$notification->created_at->diffForHumans()}}</p>
                    </div>
                </a>
            </li>
    @endforeach

</li>
