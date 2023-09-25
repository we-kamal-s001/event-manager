<?php namespace VaahCms\Modules\Events\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use VaahCms\Modules\Events\Models\Manager;
use WebReinvent\VaahCms\Models\TaxonomyBase;


class managersController extends Controller
{


    //----------------------------------------------------------
    public function __construct()
    {

    }

    //----------------------------------------------------------

    public function getAssets(Request $request)
    {

        try {

            $data = [];

            $data['permission'] = \Auth::user()->permissions(true);
            $data['rows'] = config('vaahcms.per_page');

            $data['fillable']['columns'] = Manager::getFillableColumns();
            $data['fillable']['except'] = Manager::getUnFillableColumns();
            $data['empty_item'] = Manager::getEmptyItem();
            $data['category'] = TaxonomyBase::getTaxonomyByType('category');

            $data['actions'] = [];

            $response['success'] = true;
            $response['data'] = $data;

        } catch (\Exception $e) {
            $response = [];
            $response['success'] = false;
            if (env('APP_DEBUG')) {
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else {
                $response['errors'][] = 'Something went wrong.';
            }
        }

        return $response;
    }

    //----------------------------------------------------------
    public function getList(Request $request)
    {
        try {
            return Manager::getList($request);
        } catch (\Exception $e) {
            $response = [];
            $response['success'] = false;
            if (env('APP_DEBUG')) {
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else {
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;
        }
    }

    //----------------------------------------------------------
    public function updateList(Request $request)
    {
        try {
            return Manager::updateList($request);
        } catch (\Exception $e) {
            $response = [];
            $response['success'] = false;
            if (env('APP_DEBUG')) {
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else {
                $response['errors'][] = 'Something went wrong.';

            }
            return $response;
        }
    }

    //----------------------------------------------------------
    public function listAction(Request $request, $type)
    {


        try {
            return Manager::listAction($request, $type);
        } catch (\Exception $e) {
            $response = [];
            $response['success'] = false;
            if (env('APP_DEBUG')) {
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else {
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;

        }
    }

    //----------------------------------------------------------
    public function deleteList(Request $request)
    {
        try {
            return Manager::deleteList($request);
        } catch (\Exception $e) {
            $response = [];
            $response['success'] = false;
            if (env('APP_DEBUG')) {
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else {
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;
        }
    }

    //----------------------------------------------------------
    public function fillItem(Request $request)
    {
        try {
            return Manager::fillItem($request);
        } catch (\Exception $e) {
            $response = [];
            $response['success'] = false;
            if (env('APP_DEBUG')) {
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else {
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;
        }
    }

    //----------------------------------------------------------
    public function createItem(Request $request)
    {
        try {
            return Manager::createItem($request);
        } catch (\Exception $e) {
            $response = [];
            $response['success'] = false;
            if (env('APP_DEBUG')) {
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else {
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;
        }
    }

    //----------------------------------------------------------
    public function getItem(Request $request, $id)
    {
        try {
            return Manager::getItem($id);
        } catch (\Exception $e) {
            $response = [];
            $response['success'] = false;
            if (env('APP_DEBUG')) {
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else {
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;
        }
    }

    //----------------------------------------------------------
    public function updateItem(Request $request, $id)
    {
        try {
            return Manager::updateItem($request, $id);
        } catch (\Exception $e) {
            $response = [];
            $response['success'] = false;
            if (env('APP_DEBUG')) {
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else {
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;
        }
    }

    //----------------------------------------------------------
    public function deleteItem(Request $request, $id)
    {
        try {
            return Manager::deleteItem($request, $id);
        } catch (\Exception $e) {
            $response = [];
            $response['success'] = false;
            if (env('APP_DEBUG')) {
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else {
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;
        }
    }

    //----------------------------------------------------------
    public function itemAction(Request $request, $id, $action)
    {
        try {
            return Manager::itemAction($request, $id, $action);
        } catch (\Exception $e) {
            $response = [];
            $response['success'] = false;
            if (env('APP_DEBUG')) {
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else {
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;
        }
    }
    //----------------------------------------------------------


}
