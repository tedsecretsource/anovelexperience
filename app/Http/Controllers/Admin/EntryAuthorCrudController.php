<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EntryAuthorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Traits\Fonts;

/**
 * Class EntryAuthorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EntryAuthorCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use Fonts;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    public function setup()
    {
        $this->crud->setModel('App\EntryAuthor');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/entryauthor');
        $this->crud->setEntityNameStrings('entry author', 'entry authors');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Author\'s Name',
            'wrapper' => [
                'element' => 'span',
                'style' => function ($crud, $column, $entry, $related_key) {
                    return 'font-family: "' . $this->get_font(json_decode($entry, true)['font'])['name'] . '"';
                }
            ]
        ]);
        // $this->crud->addFilter(
        //     [
        //         'name' => 'novel',
        //         'type' => 'dropdown',
        //         'label' => 'Novel'
        //     ],
        //     \App\Novel::get()->pluck('title', 'id')->sortBy('title')->toArray(),
        //     function ($value) {
        //         $this->crud->addClause('where', 'novel_id', $value);
        //     }
        // );
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(EntryAuthorRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Author\'s Name',
        ]);
        $this->crud->addField([
            'name' => 'font',
            'type' => 'select_from_array',
            'label' => 'Font',
            'options' => $this->get_fonts_for_select(),
            'attributes' => ['data-preview' => 'preview-font']
        ]);
        $this->crud->addField([
            'name' => 'font_preview',
            'type' => 'custom_html',
            'value' => '<div class="my-font-preview">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed risus sed turpis lobortis consectetur et malesuada dui. Integer tincidunt sodales sem sed blandit. Etiam porta sit amet felis vel iaculis. Integer euismod placerat sapien, quis vehicula tellus vehicula sit amet. Nam ac metus velit. Phasellus aliquet nulla et tortor finibus, at varius quam ultrices. Fusce rutrum ut arcu eu faucibus. Duis commodo, nisl eget sodales ornare, erat sem eleifend eros, at tempor lectus lacus a justo. Aenean et ullamcorper nisi, sit amet rutrum velit. Curabitur vitae elit enim. Nam ultrices consequat blandit. Integer sit amet venenatis lacus. Nullam venenatis venenatis ligula, sed rhoncus augue suscipit non. Cras vel leo ut sem aliquam gravida non non purus. </div>',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
