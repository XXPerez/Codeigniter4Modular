<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Setup how the exception handler works.
 *
 * @package Config
 */
class Exceptions extends BaseConfig
{
	/*
	 |--------------------------------------------------------------------------
	 | LOG EXCEPTIONS?
	 |--------------------------------------------------------------------------
	 | If true, then exceptions will be logged
	 | through Services::Log.
	 |
	 | Default: true
	 */
	public $log = true;

	/*
	 |--------------------------------------------------------------------------
	 | DO NOT LOG STATUS CODES
	 |--------------------------------------------------------------------------
	 | Any status codes here will NOT be logged if logging is turned on.
	 | By default, only 404 (Page Not Found) exceptions are ignored.
	 */
	public $ignoreCodes = [ 404 ];

	/*
	|--------------------------------------------------------------------------
	| Error Views Path
	|--------------------------------------------------------------------------
	| This is the path to the directory that contains the 'cli' and 'html'
	| directories that hold the views used to generate errors.
	|
	| Default: APPPATH.'Views/errors'
	*/
	public $errorViewPath = APPPATH . 'Views/errors';

        /*
        * --------------------------------------------------------------------------
        * HIDE FROM DEBUG TRACE
        * --------------------------------------------------------------------------
        * Any data that you would like to hide from the debug trace.
        * In order to specify 2 levels, use "/" to separate.
        * ex. ['server', 'setup/password', 'secret_token']
        *
        * @var array
        */
        public $sensitiveDataInTrace = [];        
}
