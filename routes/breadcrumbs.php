<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('riding-class', function ($trail) {
    $trail->parent('home');
    $trail->push('Riding Class', route('riding_class'));
});

Breadcrumbs::for('riding-class-search', function ($trail) {
    $trail->parent('riding-class');
    $trail->push('Search', route('riding_class.search'));
});

// PACAKAGE
Breadcrumbs::for('package-booking', function ($trail, $package) {
    $trail->parent('riding-class');
    $trail->push($package->name);
    $trail->push('Booking');
});

Breadcrumbs::for('package-payment-method', function ($trail, $package) {
    $trail->parent('riding-class');
    $trail->push($package->name);
    $trail->push('Payment method');
});

Breadcrumbs::for('package-payment-confirmation', function ($trail, $package) {
    $trail->parent('riding-class');
    $trail->push($package->name);
    $trail->push('Payment confirmation');
});

// Profile
Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('home');
    $trail->push('Profile', route('user.personal_information'));
});
Breadcrumbs::for('profile-password', function ($trail) {
    $trail->parent('profile');
    $trail->push('Change Password', route('user.change_password'));
});

Breadcrumbs::for('order-history', function ($trail) {
    $trail->parent('profile');
    $trail->push('Order History', route('user.order_history'));
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
Breadcrumbs::for('stable-schedule-create', function ($trail) {
    $trail->parent('stable-schedule');
    $trail->push('Create', route('stable.schedule.create'));
});
Breadcrumbs::for('stable-schedule-edit', function ($trail) {
    $trail->parent('stable-schedule');
    $trail->push('Edit', route('stable.schedule.edit', 1));
});
// Stable Admin
Breadcrumbs::for('stable-admin', function ($trail) {
    $trail->parent('stable-dashboard');
    $trail->push('Stable Admin', route('stable.admin.index'));
});
Breadcrumbs::for('stable-admin-create', function ($trail) {
    $trail->parent('stable-admin');
    $trail->push('Create', route('stable.admin.create'));
});

// App Owner
Breadcrumbs::for('owner-dashboard', function ($trail) {
    $trail->parent('home');
    $trail->push('App Owner', route('app_owner.index'));
});

// App Owner Stable Approval Step 1
Breadcrumbs::for('owner-stable-approval-step-1', function ($trail) {
    $trail->parent('owner-dashboard');
    $trail->push('Stable Approval Step 1', route('app_owner.stable.approval.step_1.index'));
});
// App Owner Stable Approval Step 2
Breadcrumbs::for('owner-stable-approval-step-2', function ($trail) {
    $trail->parent('owner-dashboard');
    $trail->push('Stable Approval Step 2', route('app_owner.stable.approval.step_2.index'));
});
// App Owner Stable Review
// Review Dashboard
Breadcrumbs::for('owner-stable-review-dashboard', function ($trail) {
    $trail->parent('owner-stable-approval-step-2');
    $trail->push('Dashboard Review', route('app_owner.stable.approval.step_2.show',1));
});
// Review Horse
Breadcrumbs::for('owner-stable-review-horse', function ($trail) {
    $trail->parent('owner-stable-approval-step-2');
    $trail->push('Horse Review', route('app_owner.stable.horse',1));
});
// Review Package
Breadcrumbs::for('owner-stable-review-package', function ($trail) {
    $trail->parent('owner-stable-approval-step-2');
    $trail->push('Package Review', route('app_owner.stable.package',1));
});
// Review Schedule
Breadcrumbs::for('owner-stable-review-schedule', function ($trail) {
    $trail->parent('owner-stable-approval-step-2');
    $trail->push('Schedule Review', route('app_owner.stable.schedule',1));
});
// Review Coach
Breadcrumbs::for('owner-stable-review-coach', function ($trail) {
    $trail->parent('owner-stable-approval-step-2');
    $trail->push('Coach Review', route('app_owner.stable.coach',1));
});

// App Owner Horse Sex
Breadcrumbs::for('owner-horse-sex', function ($trail) {
    $trail->parent('stable-dashboard');
    $trail->push('Horse Sex', route('app_owner.horse.horse_sex.index'));
});
Breadcrumbs::for('owner-horse-sex-create', function ($trail) {
    $trail->parent('owner-horse-sex');
    $trail->push('Create', route('app_owner.horse.horse_sex.create'));
});
Breadcrumbs::for('owner-horse-sex-edit', function ($trail) {
    $trail->parent('owner-horse-sex');
    $trail->push('Edit', route('app_owner.horse.horse_sex.edit', 1));
});

// App Owner Horse Breed
Breadcrumbs::for('owner-horse-breed', function ($trail) {
    $trail->parent('stable-dashboard');
    $trail->push('Horse Breed', route('app_owner.horse.horse_breed.index'));
});
Breadcrumbs::for('owner-horse-breed-create', function ($trail) {
    $trail->parent('owner-horse-breed');
    $trail->push('Create', route('app_owner.horse.horse_breed.create'));
});
Breadcrumbs::for('owner-horse-breed-edit', function ($trail) {
    $trail->parent('owner-horse-breed');
    $trail->push('Edit', route('app_owner.horse.horse_breed.edit', 1));
});

// App Owner Bank Setting
Breadcrumbs::for('owner-bank', function ($trail) {
    $trail->parent('owner-dashboard');
    $trail->push('Bank', route('app_owner.bank.index'));
});
Breadcrumbs::for('owner-bank-create', function ($trail) {
    $trail->parent('owner-bank');
    $trail->push('Create', route('app_owner.bank.create'));
});
Breadcrumbs::for('owner-bank-edit', function ($trail) {
    $trail->parent('owner-bank');
    $trail->push('Edit', route('app_owner.bank.edit', 1));
});

// App Owner Admin
Breadcrumbs::for('owner-admin', function ($trail) {
    $trail->parent('owner-dashboard');
    $trail->push('App Owner Admin', route('app_owner.admin.index'));
});
Breadcrumbs::for('owner-admin-create', function ($trail) {
    $trail->parent('owner-admin');
    $trail->push('Create', route('app_owner.admin.create'));
});