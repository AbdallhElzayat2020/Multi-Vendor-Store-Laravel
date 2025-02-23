
<?php

return [
    [
        'icon' => 'bi bi-grid',
        'route' => 'dashboard.dashboard',
        'title' => 'Dashboard',
        'badge' => 'New',
        'active' => 'dashboard',
        'ability' => 'dashboard.view',
    ],
    [
        'icon' => 'bi bi-grid',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories',
        'active' => 'dashboard.categories.*',
        'ability' => 'categories.view',
    ],
    [
        'icon' => 'bi bi-grid',
        'route' => 'dashboard.products.index',
        'title' => 'Products',
        'active' => 'dashboard.products.*',
        'ability' => 'products.view',
    ],
    [
        'icon' => 'bi bi-grid',
        'route' => 'dashboard.roles.index',
        'title' => 'Roles',
        'active' => 'dashboard.roles.*',
        'ability' => 'roles.view',
    ],
//    [
//        'icon' => 'ri-account-pin-box-fill',
//        'route' => 'dashboard.products.index',
//        'title' => 'Users',
//        'active' => 'dashboard.users.*',
//        'ability' => 'users.view',
//    ],
];
