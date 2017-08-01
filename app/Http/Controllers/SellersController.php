<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\SellersService;
use Illuminate\Http\Request;


class SellersController extends Controller
{
    /**
     * The SellersService implementation.
     *
     * @var \App\Http\Services\SellersService
    */
    protected $sellersService;

    /**
     * Create a new SellersService instances.
     *
     * @param  \App\Http\Services\SellersService  $sellersService
     * @return array
    */
    function __construct(SellersService $sellersService)
    {
      $this->sellersService = $sellersService;
    }

    /**
     * Get all Sellers with Sales.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
    */
    public function get()
    {
      return $this->sellersService->get();
    }

    /**
     * Create a new Seller.
     *
     * @param   \Illuminate\Http\Request  $request
     * @return array
    */
    public function store(Request $request)
    {
      return  $this->sellersService->store($request->all());
    }

    /**
     * Create a new Sale for a Seller.
     *
     * @param  integer  $id
     * @param  \Illuminate\Http\Request  $request
     * @return array
    */
    public function newSale($id, Request $request)
    {
      return  $this->sellersService->newSale($id, $request->all());
    }

    /**
     * Get the sales of a seller.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
    */
    public function getSellerSales($id)
    {
      return  $this->sellersService->getSellerSales($id);
    }

}
