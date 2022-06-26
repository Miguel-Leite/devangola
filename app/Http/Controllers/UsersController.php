<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Interfaces\IUsersRepository;
use Hamcrest\Core\HasToString;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UsersController extends controller
{
  private $usersRepository, $validationsRules = [];

  public function __construct(IUsersRepository $usersRepository)
  {
    $this->usersRepository = $usersRepository;
    $this->validationsRules = [
      'name' => 'required',
      'email' => 'required|unique:user',
      'password' => 'required'
    ];
  }

  /**
   * Register a new user.
   *
   * @param  App\Http\Requests\CityRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(UsersRequest $request)
  {
    $userExists = User::find($request->email, '*');
    if ($userExists) {
      return response()->json([
        "message" => "User Already Register"
      ], 400);
    }

    $hashPassword = Hash::make($request->password);

    $userSave = User::Create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => $hashPassword,
    ]);
    $userSave->save();

    return json_encode([
      "success" => true,
      "message" => "User Register with Success.",
      "data" => $userSave
    ], 201);
  }

  /**
   * Atualizar cidades.
   *
   * @param  App\Http\Requests\CityRequest  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function update(UsersRequest $request, $id)
  {
    $validator = Validator::make($request->all(), $this->validationRules);

    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 400);
    }

    $user = $this->usersRepository->update($request->all(), $id);

    if (!$user) {
      return response()->json(["error" => "Inexistent User"], 400);
    }

    return response()->json([
      "message" => "User Updated with success",
      "success" => true
    ], 200);
  }

  public function show()
  {
    return response()->json([
      "message" => "All Users",
      "data" => $this->usersRepository->show(),
    ], 200);
  }

  public function index($id)
  {
    $user = $this->usersRepository->index($id);

    if ($user === false) {
      return response()->json([
        "Error" => "User Not Exists"
      ], 400);
    }
    return response()->json([
      "message" => "User Data",
      "data" => $user
    ], 200);
  }

  /**
   * Atualizar cidades.
   *
   * @param  App\Http\Requests\CityRequest  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function delete(int $id)
  {
    return response()->json([
      "message" => "User Deleted",
      "data" => $this->usersRepository->delete($id),
    ]);
  }
}
