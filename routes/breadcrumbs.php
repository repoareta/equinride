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
    $trail->push('Profile', route('user.personal_information'));
});
Breadcrumbs::for('profile-password', function ($trail) {
    $trail->parent('profile');
    $trail->push('Change Password', route('profile.change_password'));
});

// Stable
Breadcrumbs::for('stable-dashboard', function ($trail) {
    $trail->parent('home');
    $trail->push('Stable', route('stable.index'));
});

// Stable Horse
Breadcrumbs::for('stable-horse', function ($trail) {
    $trail->parent('stable-dashboard');
    $trail->push('Stable Horse', route('stable.horse.index'));
});
Breadcrumbs::for('stable-horse-create', function ($trail) {    
    $trail->parent('stable-horse');
    $trail->push('Create', route('stable.horse.create'));
});
Breadcrumbs::for('stable-horse-edit', function ($trail) {    
    $trail->parent('stable-horse');
    $trail->push('Edit', route('stable.horse.edit', 1));
});
// Stable Coach
Breadcrumbs::for('stable-coach', function ($trail) {
    $trail->parent('stable-dashboard');
    $trail->push('Stable Coach', route('stable.coach.index'));
});
Breadcrumbs::for('stable-coach-create', function ($trail) {    
    $trail->parent('stable-coach');
    $trail->push('Create', route('stable.coach.create'));
});
Breadcrumbs::for('stable-coach-edit', function ($trail) {    
    $trail->parent('stable-coach');
    $trail->push('Edit', route('stable.coach.edit', 1));
});
// Stable Package
Breadcrumbs::for('stable-package', function ($trail) {
    $trail->parent('stable-dashboard');
    $trail->push('Stable Package', route('stable.package.index'));
});
Breadcrumbs::for('stable-package-create', function ($trail) {    
    $trail->parent('stable-package');
    $trail->push('Create', route('stable.package.create'));
});
Breadcrumbs::for('stable-package-edit', function ($trail) {    
    $trail->parent('stable-package');
    $trail->push('Edit', route('stable.package.edit', 1));
});
// Stable Schedule
Breadcrumbs::for('stable-schedule', function ($trail) {
    $trail->parent('stable-dashboard');
    $trail->push('Stable Schedule', route('stable.schedule.index'));
});

// App Owner
Breadcrumbs::for('owner-dashboard', function ($trail) {
    $trail->parent('home');
    $trail->push('App Owner', route('app_owner.index'));
});

// App Owner Stable Approval Step 1
Breadcrumbs::for('owner-stable-approval-step-1', function ($trail) {
    $trail->parent('owner-dashboard');
    $trail->push('Stable Approval Step 1', route('app_owner.stable.approval.step_1'));
});
// App Owner Stable Approval Step 2
Breadcrumbs::for('owner-stable-approval-step-2', function ($trail) {
    $trail->parent('owner-dashboard');
    $trail->push('Stable Approval Step 2', route('app_owner.stable.approval.step_2'));
});

// App Owner Bank Setting
Breadcrumbs::for('owner-bank', function ($trail) {
    $trail->parent('owner-dashboard');
    $trail->push('Bank', route('app_owner.bank.index'));
});