<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EntryRequest;
use App\Traits\Fonts;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EntryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EntryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use Fonts;

    public function setup()
    {
        $this->crud->setModel('App\Entry');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/entry');
        $this->crud->setEntityNameStrings('entry', 'entries');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->addColumn(['name' => 'novel_id', 'type' => 'select', 'label' => 'Novel', 'entity' => 'novel', 'attribute' => 'title', 'model' => 'App\Novel']);
        $this->crud->addColumn(['name' => 'author', 'type' => 'relationship', 'entity' => 'author', 'attribute' => 'name']);
        $this->crud->addColumn(['name' => 'order', 'type' => 'number']);
        $this->crud->addColumn(['name' => 'entry_date', 'type' => 'datetime']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(EntryRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
        $this->crud->addField([
            'name' => 'novel_id',
            'label' => 'Novel',
            'type' => 'relationship',
            'entity' => 'novel',
            'attribute' => 'title'
        ]);
        $this->crud->addField(['name' => 'entry_author_id', 'type' => 'relationship', 'entity' => 'author', 'attribute' => 'name']);
        $this->crud->addField([
            'name' => 'order',
            'type' => 'number',
            'label' => 'Order'
        ]);
        $this->crud->addField([
            'name' => 'entry_date',
            'type' => 'datetime',
            'label' => 'Date of Entry'
        ]);
        $this->crud->addField([
            'name' => 'entry',
            'type' => 'simplemde',
            'label' => 'Entry Text'
        ]);
        $this->crud->addField([
            'name' => 'editors_note',
            'type' => 'textarea',
            'label' => 'Editor\'s Note'
        ]);
        $this->crud->addField([
            'name' => 'font',
            'type' => 'select_from_array',
            'label' => 'Font',
            'options' => $this->get_fonts_for_select(),
            'allows_null' => true
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
