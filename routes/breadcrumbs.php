<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('riding-class', function ($trail) {
    $trail->parent('home');
    $trail->push('Riding Class', route('riding_class'));
});

// Profile
Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('home');
    $trail->push('Profile', route('profile.personal-information'));
});
Breadcrumbs::for('profile-password', function ($trail) {
    $trail->parent('profile');
    $trail->push('Change Password', route('profile.change-password'));
});

// Stable
Breadcrumbs::for('stable-dashboard', function ($trail) {
    $trail->parent('home');
    $trail->push('Stable', route('stable.index'));
});

Breadcrumbs::for('stable-horse', function ($trail) {
    $trail->parent('stable-dashboard');
    $trail->push('Stable Horse', route('stable.horse.index'));
});
