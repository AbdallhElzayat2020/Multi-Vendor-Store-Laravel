
<?php

return [
    [
        'icon' => 'bi bi-grid',
        'route' => 'dashboard',
        'title' => 'Dashboard',
        'badge' => 'New',
        'active' => 'dashboard'
    ],
    [
        'icon' => 'bi bi-grid',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories',
        'active' => 'dashboard.categories.*'
    ],
    [
        'icon' => 'bi bi-grid',
        'route' => 'dashboard.products.index',
        'title' => 'Products',
        'active' => 'dashboard.products.*'
    ]
];
