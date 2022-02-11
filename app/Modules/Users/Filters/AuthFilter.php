<?php
namespace Users\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null) {
       
        if (!session()->get('isLoggedIn')) {
            $uri = $request->uri;
            $path = $uri->getPath(); 
            if ($path != '') {
                session()->setFlashdata('redirectUri', base_url().'/'.$uri->getPath());
            }
            return redirect()->to(base_url() . '/login');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        $redirectUri = session()->getFlashdata('redirectUri');
        if ($redirectUri != '') {
            return redirect()->to($redirectUri);
        }

    }

}
