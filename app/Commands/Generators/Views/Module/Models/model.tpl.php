<?php

/**
 * This file contains the {moduleName}Model class for the {moduleName} module.
 *
 * @package {moduleName}\Models
 */

namespace App\Modules\{moduleName}\Models;

use CodeIgniter\Model;

class {moduleName}Model extends Model
{
    /**
     * The table name to use in the database
     *
     * @var string
     */
    protected $table = 'test';

    /**
     * The primary key of the table
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The validation rules to use when inserting or updating data
     *
     * @var array
     */
    protected $validationRules = [];

    /**
     * The validation messages to use when validation fails
     *
     * @var array
     */
    protected $validationMessages = [];

    /**
     * The allowed fields to insert or update in the table
     *
     * @var array
     */
    protected $allowedFields = [];

    /**
     * The constructor of the class
     *
     * Initializes the parent model class
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function generateFakeData()
    {
        return [
            [
                'first' => 'PHP',
                'email' => 'php@example.com',
                'phone' => '+7 (999) 111-22-33',
                'avatar' => 'https://example.com/images/php.jpg',
                'login' => '2021-12-01'
            ],
            [
                'first' => 'Python',
                'email' => 'python@example.com',
                'phone' => '+7 (888) 222-33-44',
                'avatar' => 'https://example.com/images/python.jpg',
                'login' => null
            ],
            [
                'first' => 'Java',
                'email' => 'java@example.com',
                'phone' => '+7 (777) 333-44-55',
                'avatar' => 'https://example.com/images/java.jpg',
                'login' => '2021-11-30'
            ]
        ];
    }
}
