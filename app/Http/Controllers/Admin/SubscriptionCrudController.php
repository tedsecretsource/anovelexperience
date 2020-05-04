<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SubscriptionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SubscriptionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SubscriptionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Subscription');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/subscription');
        $this->crud->setEntityNameStrings('subscription', 'subscriptions');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->addColumn(
            [
                'name' => 'subscriber',
                'label' => 'Subscriber',
                'type' => 'relationship',
                'entity' => 'subscriber',
                'attribute' => 'name',
            ]
        );
        $this->crud->addColumn(
            [
                'name' => 'novel',
                'label' => 'Novel',
                'type' => 'relationship',
                'entity' => 'novel',
                'attribute' => 'title',
            ]
        );
        $this->crud->addColumn(
            [
                'name' => 'type',
                'label' => 'Type',
                'type' => 'text',
            ]
        );
        $this->crud->addColumn(
            [
                'name' => 'status',
                'label' => 'Status',
                'type' => 'text',
            ]
        );
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(SubscriptionRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
        $this->crud->addField([
            'name' => 'user_id',
            'label' => 'Subscriber',
            'type' => 'relationship',
            'entity' => 'subscriber',
            'attribute' => 'name',
            'model' => 'App\User'
        ]);

        $this->crud->addField([
            'name' => 'subscribed',
            'label' => 'Date Subscribed',
            'type' => 'datetime',
            'default' => now()
        ]);

        $this->crud->addField([
            'name' => 'novel_id',
            'label' => 'Novel',
            'type' => 'relationship',
            'entity' => 'novel',
            'attribute' => 'title',
            'model' => 'App\Novel'
        ]);

        $this->crud->addField([
            'name' => 'type',
            'label' => 'Subscription Type',
            'type' => 'select_from_array',
            'options' => \App\SubscriptionType::get()->pluck('type', 'type')->toArray(),
            'allows_null' => false,
        ]);

        $this->crud->addField([
            'name' => 'status',
            'label' => 'Subscription Status',
            'type' => 'select_from_array',
            'options' => \App\SubscriptionStatus::get()->pluck('status', 'status')->toArray(),
            'allows_null' => false,
        ]);

        $this->crud->addField([
            'name' => 'payment_confirmation_id',
            'label' => 'Payment Confirmation ID',
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'payment_date',
            'label' => 'Date Paid',
            'type' => 'datetime',
            'default' => now()
        ]);

        $this->crud->addField([
            'name' => 'payment_amount',
            'label' => 'Amount',
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'payment_status',
            'label' => 'Payment Status',
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'first_entry_date',
            'label' => 'First Entry Date',
            'type' => 'datetime',
            'default' => now()
        ]);

        $this->crud->addField([
            'name' => 'pace',
            'label' => 'Pace',
            'type' => 'select_from_array',
            'options' => [0.5, 1, 2, 3, 4, 5, 6, 7, 8],
            'default' => 1
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function typesAsArray()
    {
        foreach (\App\SubscriptionType::all(['type'])->sortBy('type')->toArray() as $key => $value) {
            $options[] = $value['type'];
        }
        return $options;
    }
}
