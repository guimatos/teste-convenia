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

    public function newSale($id, Request $request)
    {
      return  $this->sellersService->newSale($id, $request->all());
    }

    public function getSellerSales($id)
    {
      return  $this->sellersService->getSellerSales($id);
    }

}
