<?php

use inf1111\CheckboxAjax\CheckboxAjaxController;

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
], function () {

    Route::post("check-ajax-handler", CheckboxAjaxController::class)->name('check-ajax-handler');

});



