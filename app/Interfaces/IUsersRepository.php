<?php

namespace App\Interfaces;

use App\Http\Requests\UsersRequest;

interface IUsersRepository
{
  public function register(UsersRequest $request);
  public function update($request, int $id);
  public function delete(int $id);
  public function show();
  public function index(int $id);
}
