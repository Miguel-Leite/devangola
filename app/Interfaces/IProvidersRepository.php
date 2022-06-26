<?php

namespace App\Interfaces;

use App\Http\Requests\ProvidersRequest;


interface IProvidersRepository
{
  public function show();
  public function index(int $id);

  public function register(ProvidersRequest $request);
  public function update($request, int $id);

  public function delete(int $id);
}
