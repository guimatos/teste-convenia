<?php
namespace App\Http\Repositories\Eloquent;
use App\Http\Repositories\Eloquent\Repository;

class SaleRepository extends Repository
{
    /**
     * Instance the Sale Model
     *
     * @return void
    */

    function model()
    {
        return 'App\Models\Sale';
    }

}
