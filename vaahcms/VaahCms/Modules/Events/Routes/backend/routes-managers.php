<?php

Route::group(
    [
        'prefix' => 'backend/events/managers',
        
        'middleware' => ['web', 'has.backend.access'],
        
        'namespace' => 'Backend',
],
function () {
    /**
     * Get Assets
     */
    Route::get('/assets', 'managersController@getAssets')
        ->name('vh.backend.events.managers.assets');
    /**
     * Get List
     */
    Route::get('/', 'managersController@getList')
        ->name('vh.backend.events.managers.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', 'managersController@updateList')
        ->name('vh.backend.events.managers.list.update');
    /**
     * Delete List
     */
    Route::delete('/', 'managersController@deleteList')
        ->name('vh.backend.events.managers.list.delete');


    /**
     * Fill Form Inputs
     */
    Route::any('/fill', 'managersController@fillItem')
        ->name('vh.backend.events.managers.fill');

    /**
     * Create Item
     */
    Route::post('/', 'managersController@createItem')
        ->name('vh.backend.events.managers.create');
    /**
     * Get Item
     */
    Route::get('/{id}', 'managersController@getItem')
        ->name('vh.backend.events.managers.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', 'managersController@updateItem')
        ->name('vh.backend.events.managers.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', 'managersController@deleteItem')
        ->name('vh.backend.events.managers.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', 'managersController@listAction')
        ->name('vh.backend.events.managers.list.actions');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', 'managersController@itemAction')
        ->name('vh.backend.events.managers.item.action');

    //---------------------------------------------------------

});
