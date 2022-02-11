<?php 
namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
            return redirect()->to(base_url() . '/dashboard');

            return view('welcome_message');
	}

	//--------------------------------------------------------------------

}
