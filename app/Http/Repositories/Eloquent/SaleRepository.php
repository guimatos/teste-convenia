<?php
namespace App\Http\Repositories\Eloquent;
use App\Http\Repositories\Eloquent\Repository;
/**
*
*/
class SaleRepository extends Repository
{

    function model()
    {
        return 'App\Models\Sale';
    }

}
