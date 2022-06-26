<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use App\Repositories\ProductsRepositoryImpl;
use App\Http\Repositories\ProvidersRepositoryImpl;

use App\Interfaces\IProvidersRepository;
use App\Interfaces\IProductsRepository;

use App\Models\Products;
use App\Http\Requests\ProductsRequest;

class ProductsController extends Controller
{
    private $productsRepositoryImpl;
    private $providersRepositoryImpl;

    /**
     *
     * @param  App\Http\Requests\ProvidersRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function __construct(IProductsRepository $productsRepositoryImpl, IProvidersRepository $providersRepositoryImpl)
    {
        $this->productsRepositoryImpl = $productsRepositoryImpl;
        $this->providersRepositoryImpl = $providersRepositoryImpl;
    }

    public function store(ProductsRequest $request)
    {
        $providerExists = $this->providersRepositoryImpl->index($request->providerId);

        if (!$providerExists) {
            return response()->json([
                "success" => false,
                "message" => "Provider Not Exists"
            ], 400);
        }

        $productModel = new Products;

        $productModel->name = $request->name;
        $productModel->cod = $request->cod;
        $productModel->batch = $request->batch;
        $productModel->price = $request->price;
        $productModel->providerId = $request->providerId;
        $productModel->save();

        return json_encode([
            "success" => true,
            "message" => "Product Added",
            "data" => $productModel
        ], 201);
    }

    /**
     *
     * @param  App\Http\Requests\ProvidersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(ProductsRequest $request, $id)
    {
        $productExist = $this->productsRepositoryImpl->index($id);

        if (!$productExist) {
            return response()->json(["error" => "Inexistent Provider"], 400);
        }

        $product = new Products;

        $product->name = $request->name ?? $productExist['name'];
        $product->cod = $request->cod ?? $productExist['cod'];
        $product->batch = $request->batch ?? $productExist['batch'];
        $product->providerId = $request->providerId ?? $productExist['providerId'];
        $product->price = $request->price ?? $productExist['price'];
        $product->save();


        return response()->json([
            "success" => true,
            "message" => "Provider Updated with success",
        ], 200);
    }

    /**
     *
     * @param  App\Http\Requests\ProvidersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {
        $product = $this->providersRepositoryImpl->index($id);

        if (!$product) {
            return response()->json([
                "success" => false,
                "message" => "Provider Not Exists"
            ], 400);
        }

        return response()->json([
            "success" => true,
            "message" => "Product Data",
            "data" => $product
        ], 200);
    }

    public function show()
    {
        return response()->json([
            "success" => true,
            "message" => "All Products",
            "data" => $this->productsRepositoryImpl->show()
        ], 200);
    }

    /**
     *
     * @param  App\Http\Requests\ProvidersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $product = $this->productsRepositoryImpl->index($id);

        if (!$product) {
            return response()->json([
                "success" => false,
                "message" => "Product Not Exists"
            ], 400);
        }

        $this->productsRepositoryImpl->delete($id);

        return response()->json([
            "success" => true,
            "message" => "Product Removed"
        ], 200);
    }
}
