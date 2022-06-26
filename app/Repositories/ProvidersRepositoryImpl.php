<?php

namespace App\Repositories;

use App\Http\Requests\ProvidersRequest;
use App\Models\Providers;
use App\Interfaces\IProvidersRepository;

class ProvidersRepositoryImpl implements IProvidersRepository
{
  private $provider;

  public function __construct(Providers $provider)
  {
    $this->provider = $provider;
  }

  public function show()
  {
    return $this->provider::all();
  }
  public function index(int $id)
  {
    $provider = $this->provider::find($id);

    if (!$provider) {
      return false;
    }
    return $provider;
  }

  public function register(ProvidersRequest $request)
  {
    return $this->provider::create($request);
  }

  public function update($request, int $id)
  {
    $provider = $this->provider::find($id);

    if (!$provider) {
      return false;
    }

    return $this->provider::where('id', $id)->update($request);
  }

  public function delete(int $id)
  {
    return $this->provider::destroy($id);
  }
}
