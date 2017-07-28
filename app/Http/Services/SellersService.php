<?php

namespace App\Http\Services;

use App\Http\Repositories\Eloquent\SellerRepository;
use Validator;

class SellersService
{

  private $sellerRepository;

  function __construct(SellerRepository $sellerRepository)
  {
      $this->sellerRepository = $sellerRepository;
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

}
