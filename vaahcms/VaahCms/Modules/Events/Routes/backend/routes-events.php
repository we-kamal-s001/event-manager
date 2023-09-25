<?php

Route::group(
    [
        'prefix' => 'backend/events/events',
        
        'middleware' => ['web', 'has.backend.access'],
        
        'namespace' => 'Backend',
],
function () {
    /**
     * Get Assets
     */
    Route::get('/assets', 'EventsController@getAssets')
        ->name('vh.backend.events.events.assets');
    /**
     * Get List
     */
    Route::get('/', 'EventsController@getList')
        ->name('vh.backend.events.events.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', 'EventsController@updateList')
        ->name('vh.backend.events.events.list.update');
    /**
     * Delete List
     */
    Route::delete('/', 'EventsController@deleteList')
        ->name('vh.backend.events.events.list.delete');


    /**
     * Fill Form Inputs
     */
    Route::any('/fill', 'EventsController@fillItem')
        ->name('vh.backend.events.events.fill');

    /**
     * Create Item
     */
    Route::post('/', 'EventsController@createItem')
        ->name('vh.backend.events.events.create');
    /**
     * Get Item
     */
    Route::get('/{id}', 'EventsController@getItem')
        ->name('vh.backend.events.events.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', 'EventsController@updateItem')
        ->name('vh.backend.events.events.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', 'EventsController@deleteItem')
        ->name('vh.backend.events.events.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', 'EventsController@listAction')
        ->name('vh.backend.events.events.list.actions');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', 'EventsController@itemAction')
        ->name('vh.backend.events.events.item.action');

    //---------------------------------------------------------

});
