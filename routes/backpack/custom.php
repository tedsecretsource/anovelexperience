<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => [
        config('backpack.base.web_middleware', 'web'),
        config('backpack.base.middleware_key', 'admin'),
    ],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('entry', 'EntryCrudController');
    Route::crud('novel', 'NovelCrudController');
    Route::crud('entryauthor', 'EntryAuthorCrudController');
    Route::crud('subscriptionstatus', 'SubscriptionStatusCrudController');
    Route::crud('subscriptiontype', 'SubscriptionTypeCrudController');
    Route::crud('subscription', 'SubscriptionCrudController');
    Route::crud('sentlog', 'SentLogCrudController');
    Route::crud('user', 'UserCrudController');
}); // this should be the absolute last line of this file