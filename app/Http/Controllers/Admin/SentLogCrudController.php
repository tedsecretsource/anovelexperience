<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SentLogRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SentLogCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SentLogCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\SentLog');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/sentlog');
        $this->crud->setEntityNameStrings('sent_log', 'sent_logs');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(
            [
                'name' => 'created_at',
                'type' => 'date',
                'label' => 'Sent On'
            ]
        );
        $this->crud->addColumn(
            [
                'name' => 'subscription_id',
                'type' => 'text',
                'label' => 'Sub'
            ]
        );
        $this->crud->addColumn(
            [
                'name' => 'user',
                'type' => 'relationship',
                'label' => 'User',
                'entity' => 'user',
                'attribute' => 'name'
            ]
        );
        $this->crud->addColumn(
            [
                'name' => 'entry',
                'type' => 'relationship',
                'label' => 'Entry',
                'entity' => 'entry',
                'attribute' => 'title'
            ]
        );
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(SentLogRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
