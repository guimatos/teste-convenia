<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\SellersService;
use Illuminate\Http\Request;

/**
 *
 */
class SellersController extends Controller
{
    protected $sellersService;

    function __construct(SellersService $sellersService)
    {
      $this->sellersService = $sellersService;
    }

    public function get()
    {
      return $this->sellersService->get();
    }

    public function store(Request $request)
    {
      return  $this->sellersService->store($request->all());
    }

}
