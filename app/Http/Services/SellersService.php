<?php

namespace App\Http\Services;

use App\Http\Repositories\Eloquent\SellerRepository;
use App\Http\Repositories\Eloquent\SaleRepository;

use Validator;

class SellersService
{

  private $sellerRepository;
  private $saleRepository;

  function __construct(SellerRepository $sellerRepository, SaleRepository $saleRepository)
  {
      $this->sellerRepository = $sellerRepository;
      $this->saleRepository = $saleRepository;
  }

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

  public function get()
  {
      try
      {
          return response()->json($this->sellerRepository->all());
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
