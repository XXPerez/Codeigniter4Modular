<?php

/**
 * This file contains the {moduleName}Library class for the {moduleName} module.
 *
 * @package App\Modules\Test\Libraries
 */

namespace App\Modules\{moduleName}\Libraries;

use CodeIgniter\Config\BaseConfig;

class {moduleName}Library
{
    /**
     * Constructor
     *
     */
    public function __construct()
    {
    }

    /**
     * A sample method that returns a greeting message
     *
     * @param string $name The name of the person to greet
     * @return string The greeting message
     */
    public function greet(string $name): string
    {
        return "Hello, {$name} from BaseLibrary!";
    }
}