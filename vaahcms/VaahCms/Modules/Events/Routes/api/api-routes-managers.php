<?php

/*
 * API url will be: <base-url>/public/api/events/managers
 */
Route::group(
    [
        'prefix' => 'events/managers',
        'namespace' => 'Backend',
    ],
function () {

    /**
     * Get Assets
     */
    Route::get('/assets', 'managersController@getAssets')
        ->name('vh.backend.events.api.managers.assets');
    /**
     * Get List
     */
    Route::get('/', 'managersController@getList')
        ->name('vh.backend.events.api.managers.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', 'managersController@updateList')
        ->name('vh.backend.events.api.managers.list.update');
    /**
     * Delete List
     */
    Route::delete('/', 'managersController@deleteList')
        ->name('vh.backend.events.api.managers.list.delete');


    /**
     * Create Item
     */
    Route::post('/', 'managersController@createItem')
        ->name('vh.backend.events.api.managers.create');
    /**
     * Get Item
     */
    Route::get('/{id}', 'managersController@getItem')
        ->name('vh.backend.events.api.managers.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', 'managersController@updateItem')
        ->name('vh.backend.events.api.managers.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', 'managersController@deleteItem')
        ->name('vh.backend.events.api.managers.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', 'managersController@listAction')
        ->name('vh.backend.events.api.managers.list.action');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', 'managersController@itemAction')
        ->name('vh.backend.events.api.managers.item.action');



});
