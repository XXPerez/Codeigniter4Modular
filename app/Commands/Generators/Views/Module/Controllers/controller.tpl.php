<?php

/**
 * This file contains the {moduleName} controller for the {moduleName} module.
 *
 * @package App\Modules\{moduleName}\Controllers 
 */

namespace App\Modules\{moduleName}\Controllers;;

use App\Controllers\BaseController;
use App\Modules\{moduleName}\Models\{moduleName}Model; // Added a model for {moduleName}
use App\Modules\{moduleName}\Libraries\{moduleName}Library; // Added a Library for {moduleName}


class {moduleName} extends BaseController
{
    /**
     * @var {moduleName}Model ${moduleName}Model The model for {moduleName}
     */
    protected ${moduleName}Model; // Added a property for the model

    /**
     * @var {moduleName}Library ${moduleName}Library The Library for ${moduleName}
     */
    protected ${moduleName}Library; // Added a property for the Library

    /**
     * Constructor
     */
    public function __construct()
    {
        // Your Magic
        $this->{moduleName}Model = new {moduleName}Model(); // Initialized the model
        $this->{moduleName}Library = new {moduleName}Library(); // Initialized the Library
    }

    /**
     * Index method
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function index()
    {
        $data = [
            "LibraryResponse" => $this->{moduleName}Library->greet("{moduleName}"),
            "ModelResponse" => $this->{moduleName}Model->generateFakeData("{moduleName}")
        ];
        helper(['form']);
        return view('{moduleName}\Views\{filename}', $data);
    }
}
