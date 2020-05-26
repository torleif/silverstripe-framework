<?php

namespace SilverStripe\Forms\Tests\GridField\GridFieldDetailFormTest;

use SilverStripe\Dev\TestOnly;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\ORM\DataObject;

class PeopleGroup extends DataObject implements TestOnly
{

    private static $table_name = 'GridFieldDetailFormTest_PeopleGroup';

    private static $db = [
        'Name' => 'Varchar'
    ];

    private static $has_many = [
        'People' => Person::class
    ];

    private static $belongs_many_many = [
        'FavouritePeople' => Person::class
    ];

    private static $default_sort = '"Name"';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        // TODO No longer necessary once FormScaffolder uses GridField
        $fields->replaceField(
            'People',
            GridField::create(
                'People',
                'People',
                $this->People(),
                GridFieldConfig_RelationEditor::create()
            )
        );
        return $fields;
    }
}
