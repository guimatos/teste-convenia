<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\ExampleService;
use Illuminate\Http\Request;

/**
 *
 */
class ProductsController extends Controller
{
    protected $ExampleService;

    function __construct(ExampleService $ExampleService)
    {
      $this->ExampleService = $ExampleService;
    }

    public function get()
    {
      return response()->json($this->ExampleService->get());
    }

}
