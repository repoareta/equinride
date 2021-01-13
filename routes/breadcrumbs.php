<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('riding-class', function ($trail) {
    $trail->parent('home');
    $trail->push('Stable Class', route('riding_class'));
});
