<?php

namespace App\Repositories;

use App\Http\Requests\UsersRequest;
use App\Models\User;
use App\Interfaces\IUsersRepository;

class UsersRepositoryImpl implements IUsersRepository
{
  private $user;
  public function __construct(User $user)
  {
    $this->user = $user;
  }

  public function register(UsersRequest $request)
  {
    return $this->user::create($request);
  }
  public function update($request, int $id)
  {
    $isUser = $this->user::find($id);

    if (!$isUser) {
      return false;
    }

    return $this->user::where('id', $id)->update($request);
  }
  public function delete(int $id)
  {
    $isUser = $this->user::find($id);

    if (!$isUser) {
      return false;
    }

    return $this->user::destroy($id);
  }

  public function show()
  {
    return $this->user::all();
  }

  public function index(int $id)
  {
    $isUser = $this->user::find($id);

    if (!$isUser) {
      return false;
    }

    return $isUser;
  }
}
