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
    Route::get('/assets', 'ManagersController@getAssets')
        ->name('vh.backend.events.managers.assets');
    /**
     * Get List
     */
    Route::get('/', 'ManagersController@getList')
        ->name('vh.backend.events.managers.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', 'ManagersController@updateList')
        ->name('vh.backend.events.managers.list.update');
    /**
     * Delete List
     */
    Route::delete('/', 'ManagersController@deleteList')
        ->name('vh.backend.events.managers.list.delete');


    /**
     * Fill Form Inputs
     */
    Route::any('/fill', 'ManagersController@fillItem')
        ->name('vh.backend.events.managers.fill');

    /**
     * Create Item
     */
    Route::post('/', 'ManagersController@createItem')
        ->name('vh.backend.events.managers.create');
    /**
     * Get Item
     */
    Route::get('/{id}', 'ManagersController@getItem')
        ->name('vh.backend.events.managers.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', 'ManagersController@updateItem')
        ->name('vh.backend.events.managers.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', 'ManagersController@deleteItem')
        ->name('vh.backend.events.managers.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', 'ManagersController@listAction')
        ->name('vh.backend.events.managers.list.actions');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', 'ManagersController@itemAction')
        ->name('vh.backend.events.managers.item.action');

    //---------------------------------------------------------

});
