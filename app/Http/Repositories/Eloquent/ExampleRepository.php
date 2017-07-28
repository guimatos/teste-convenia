<?php
namespace App\Http\Repositories\Eloquent;
use App\Http\Repositories\Eloquent\Repository;
/**
*
*/
class ExampleRepository extends Repository
{

    function model()
    {
        return 'App\Models\Model';
    }

}
