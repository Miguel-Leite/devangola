<?php

namespace App\Repositories;

use App\Http\Requests\ProductsRequest;
use App\Models\Products;
use App\Interfaces\IProductsRepository;

class ProductsRepositoryImpl implements IProductsRepository
{
  private $products;

  public function __construct(Products $products)
  {
    $this->products = $products;
  }

  public function show()
  {
    return $this->products::all();
  }
  public function index(int $id)
  {
    $product = $this->products::find($id);

    if (!$product) {
      return false;
    }
    return $product;
  }

  public function register(ProductsRequest $request)
  {
    return $this->products::create($request);
  }

  public function update($request, int $id)
  {
    $product = $this->products::find($id);

    if (!$product) {
      return false;
    }

    return $this->products::where('id', $id)->update($request);
  }

  public function delete(int $id)
  {
    return $this->products::destroy($id);
  }
}
