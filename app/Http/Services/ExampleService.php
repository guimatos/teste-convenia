<?php

namespace App\Http\Services;

use App\Http\Repositories\Eloquent\ExampleRepository;

class ExampleService
{

  private $exampleRepository;

  function __construct(ExampleRepository $exampleRepository)
  {
      $this->exampleRepository = $exampleRepository;
  }

  public function get()
  {

  }

}
