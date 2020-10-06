<?php
namespace Users\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null) {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url() . '/login');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // Do something here
    }

}
