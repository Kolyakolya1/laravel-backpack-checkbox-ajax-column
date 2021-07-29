# Checkbox_ajax column for Backpack 4

This package provides a ```checkbox_ajax``` column type for the [Backpack for Laravel](https://backpackforlaravel.com/) administration panel. The ```checkbox_ajax``` column allows admins to **toggle the value of a boolean, enum, datetime, date or timestamp database field _without_ leaving List view**. 

## Installation

Via Composer

``` bash
composer require inf1111/laravel-backpack-checkbox-ajax-column
```

## Usage

Inside your custom CrudController:

```php
$this->crud->addColumn([
    'name' => 'is_active',
    'label' => 'Activity',
    'type' => 'checkbox_ajax',
    'view_namespace' => 'CheckboxAjax::fields',
]);
```
## License

MIT. Please see the [license file](license.md) for more information.
