<?php

namespace App\Http\Services;

use App\Http\Repositories\Eloquent\SellerRepository;
use App\Http\Repositories\Eloquent\SaleRepository;

use Validator;

class SellersService
{
  /**
   * The SellerRepository implementation.
   *
   * @var \App\Http\Repositories\Eloquent\SellerRepository
  */
  private $sellerRepository;
  /**
   * The SellerRepository implementation.
   *
   * @var \App\Http\Repositories\Eloquent\SaleRepository
  */
  private $saleRepository;

  /**
   * Create a new SellerRepository and SaleRepository instances.
   *
   * @param  \App\Http\Repositories\Eloquent\SellerRepository  $sellerRepository
   * @param  \App\Http\Repositories\Eloquent\SaleRepository  $saleRepository
   * @return void
  */
  function __construct(SellerRepository $sellerRepository, SaleRepository $saleRepository)
  {
      $this->sellerRepository = $sellerRepository;
      $this->saleRepository = $saleRepository;
  }

  /**
   * Create a new Seller.
   *
   * @param  array  $data
   * @return array
  */
  public function store($data)
  {
      try
      {
          $validator = Validator::make($data, array(
              'email' => 'required|email|unique:sellers,email',
              'name' => 'required|string',
          ));

          if ($validator->fails())
          {
              $sellerResponse = array(
                  'errors' => array(
                      'message' => $validator->errors()->first()
                   ),
              );
              return response()->json($sellerResponse, 400);
          }

          $createSeller = $this->sellerRepository->create($data);
          $data['id'] = $createSeller;

          return response()->json($data);
      }
      catch (\Exception $e)
      {
          $errorResponse = array(
            'errors' => array(
              'message' => $e->getMessage()
            )
          );
          return response()->json($errorResponse, 400);
      }

  }

  /**
   * Get all sellers with sales.
   *
   * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
  */
  public function get()
  {
      try
      {
          return response()->json($this->sellerRepository->getSellersWithSales());
      }
      catch (\Exception $e)
      {
          $errorResponse = array(
            'errors' => array(
              'message' => $e->getMessage()
            )
          );
          return response()->json($errorResponse, 400);
      }

  }

  /**
   * Create a new Sale for a Seller.
   *
   * @param  int  $sellerId
   * @param  array  $data
   * @return array
  */
  public function newSale($sellerId, $data)
  {
      try
      {
          $data['seller_id'] = $sellerId;

          $validator = Validator::make($data, array(
              'seller_id' => 'required|integer|exists:sellers,id',
              'amount' => 'required|numeric',
          ));

          if ($validator->fails())
          {
              $sellerResponse = array(
                  'errors' => array(
                      'message' => $validator->errors()->first()
                   ),
              );
              return response()->json($sellerResponse, 400);
          }

          $saleId = $this->saleRepository->create($data);

          $saleResponse = $this->sellerRepository->getSellerSale($sellerId, $saleId);

          return response()->json($saleResponse);
      }
      catch (\Exception $e)
      {
          $errorResponse = array(
            'errors' => array(
              'message' => $e->getMessage()
            )
          );
          return response()->json($errorResponse, 400);
      }
  }

  /**
   * Get all the sales of a Seller.
   *
   * @param  int  $sellerId
   * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
  */
  public function getSellerSales($sellerId)
  {
      try
      {
          return response()->json($this->sellerRepository->getSellerSales($sellerId));
      }
      catch (\Exception $e)
      {
          $errorResponse = array(
            'errors' => array(
              'message' => $e->getMessage()
            )
          );
          return response()->json($errorResponse, 400);
      }
  }
}
