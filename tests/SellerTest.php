<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

use Faker\Factory as Faker;

class SellerTest extends TestCase
{
    /**
     * The Seller id to be used in other functions.
     *
     * @var $sellerId
    */
    public $sellerId;

    /**
     * Instance a value for sellerId.
     *
     * @return integer
    */
    public function __construct() {
        $this->sellerId = 1;
    }

    /**
     * test Create Seller.
     *
     * @return array
     */
    public function testCreateSeller()
    {
        $faker = Faker::create();

        $response = $this->call('POST', '/sellers', ['name' => $faker->name(), 'email' => $faker->safeEmail()]);
        $this->assertEquals(200, $response->status());
        $this->sellerId = json_decode( $response = $response->getContent())->id;
    }

    /**
     * test Get Sellers.
     *
     * @return array
     */
    public function testGetSellers()
    {
        $response = $this->call('GET', '/sellers');
        $this->assertEquals(200, $response->status());
    }

    /**
     * test Create new sale.
     *
     * @return array
     */
    public function testCreateNewSale()
    {
        $faker = Faker::create();

        $response = $this->call('POST', '/sellers/' . $this->sellerId . '/sale', ['amount' => $faker->randomNumber(2)]);
        $this->assertEquals(200, $response->status());
    }

    /**
     * test get sellers sales.
     *
     * @return array
     */
    public function testGetSellerSales()
    {
        $response = $this->call('GET', '/sellers/' . $this->sellerId . '/sale');
        $this->assertEquals(200, $response->status());
    }
}
