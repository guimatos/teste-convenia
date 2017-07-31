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

    public function getSellersWithSales()
    {
        $this->makeModel();
        return $this->model
                    ->leftJoin('sales', 'sellers.id', '=', 'sales.seller_id')
                    ->select('sellers.id', 'sellers.name', 'sellers.email', \DB::raw('sum(sales.amount * 0.085) as comission'))
                    ->groupBy('sellers.id')
                    ->paginate();
    }

    public function getSellerSale($sellerId, $saleId)
    {
        $this->makeModel();
        return $this->model
                    ->join('sales', 'sellers.id', '=', 'sales.seller_id')
                    ->select('sellers.id as id', 'sellers.name', 'sellers.email', 'sales.amount', \DB::raw('(sales.amount*0.085) as commission'), 'sales.created_at')
                    ->where('sellers.id', '=', $sellerId)
                    ->where('sales.id', '=', $saleId)
                    ->first();
    }

    public function getSellerSales($sellerId)
    {
        $this->makeModel();
        return $this->model
                    ->join('sales', 'sellers.id', '=', 'sales.seller_id')
                    ->select('sellers.id as id', 'sellers.name', 'sellers.email', 'sales.amount', \DB::raw('(sales.amount*0.085) as commission'), 'sales.created_at')
                    ->where('sellers.id', '=', $sellerId)
                    ->paginate();
    }
}
