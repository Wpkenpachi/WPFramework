<?php
namespace App\Controller;

use App\Controller\Controller;
use App\Model\Model;
use Framework\Render;
use App\Repository\businessRepository;

class businessController extends Controller {
    public function index($get, $body){
        $rep = new businessRepository;
        $data = $rep->businessListing($get, $body);
        Render::run()->view('page1', $data);
    }
}