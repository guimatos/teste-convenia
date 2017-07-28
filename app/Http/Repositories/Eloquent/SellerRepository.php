<?php
namespace App\Http\Repositories\Eloquent;
use App\Http\Repositories\Eloquent\Repository;
/**
*
*/
class SellerRepository extends Repository
{

    function model()
    {
        return 'App\Models\Seller';
    }

}
