<?php

/*
 * API url will be: <base-url>/public/api/events/events
 */
Route::group(
    [
        'prefix' => 'events/events',
        'namespace' => 'Backend',
    ],
function () {

    /**
     * Get Assets
     */
    Route::get('/assets', 'EventsController@getAssets')
        ->name('vh.backend.events.api.events.assets');
    /**
     * Get List
     */
    Route::get('/', 'EventsController@getList')
        ->name('vh.backend.events.api.events.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', 'EventsController@updateList')
        ->name('vh.backend.events.api.events.list.update');
    /**
     * Delete List
     */
    Route::delete('/', 'EventsController@deleteList')
        ->name('vh.backend.events.api.events.list.delete');


    /**
     * Create Item
     */
    Route::post('/', 'EventsController@createItem')
        ->name('vh.backend.events.api.events.create');
    /**
     * Get Item
     */
    Route::get('/{id}', 'EventsController@getItem')
        ->name('vh.backend.events.api.events.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', 'EventsController@updateItem')
        ->name('vh.backend.events.api.events.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', 'EventsController@deleteItem')
        ->name('vh.backend.events.api.events.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', 'EventsController@listAction')
        ->name('vh.backend.events.api.events.list.action');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', 'EventsController@itemAction')
        ->name('vh.backend.events.api.events.item.action');



});
