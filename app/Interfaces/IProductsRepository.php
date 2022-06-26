<?php

namespace App\Interfaces;

use App\Http\Requests\ProductsRequest;


interface IProductsRepository
{
  public function show();
  public function index(int $id);

  public function register(ProductsRequest $request);
  public function update($request, int $id);

  public function delete(int $id);
}