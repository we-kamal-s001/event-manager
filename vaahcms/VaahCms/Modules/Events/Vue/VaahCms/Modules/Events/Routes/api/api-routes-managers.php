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
    Route::get('/assets', 'ManagersController@getAssets')
        ->name('vh.backend.events.api.managers.assets');
    /**
     * Get List
     */
    Route::get('/', 'ManagersController@getList')
        ->name('vh.backend.events.api.managers.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', 'ManagersController@updateList')
        ->name('vh.backend.events.api.managers.list.update');
    /**
     * Delete List
     */
    Route::delete('/', 'ManagersController@deleteList')
        ->name('vh.backend.events.api.managers.list.delete');


    /**
     * Create Item
     */
    Route::post('/', 'ManagersController@createItem')
        ->name('vh.backend.events.api.managers.create');
    /**
     * Get Item
     */
    Route::get('/{id}', 'ManagersController@getItem')
        ->name('vh.backend.events.api.managers.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', 'ManagersController@updateItem')
        ->name('vh.backend.events.api.managers.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', 'ManagersController@deleteItem')
        ->name('vh.backend.events.api.managers.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', 'ManagersController@listAction')
        ->name('vh.backend.events.api.managers.list.action');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', 'ManagersController@itemAction')
        ->name('vh.backend.events.api.managers.item.action');



});
