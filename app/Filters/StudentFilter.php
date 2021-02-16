<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class StudentFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = service('uri');  
        $url = $uri->getSegment(1);
        $user = session()->get('user_type');
        // Do something here
        if($url !== $user){
            return redirect()->to('/');
        }

    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}