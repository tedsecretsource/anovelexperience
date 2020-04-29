<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NovelRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class NovelCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class NovelCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Novel');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/novel');
        $this->crud->setEntityNameStrings('novel', 'novels');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(NovelRequest::class);

        $this->crud->addField([
            'name' => 'title',
            'label' => 'Title',
            'type' => 'text'
        ]);
        $this->crud->addField([
            'name' => 'author',
            'label' => 'Author',
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'first_entry_date',
            'label' => 'Date of First Entry',
            'type' => 'datetime'
        ]);

        $this->crud->addField([
            'name' => 'last_entry_date',
            'label' => 'Date of Last Entry',
            'type' => 'datetime'
        ]);

        $this->crud->addField([
            'name' => 'summary',
            'label' => 'Summary',
            'type' => 'textarea'
        ]);

        $this->crud->addField([
            'name' => 'novel_emoji',
            'label' => 'Emoji',
            'type' => 'text'
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
