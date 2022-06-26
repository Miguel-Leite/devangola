<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProvidersRequest;
use App\Interfaces\IProvidersRepository;
use Hamcrest\Core\HasToString;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Providers;
use Illuminate\Http\Request;
use App\Services\NifValidator;

class ProvidersController extends Controller
{
    private $providersRepositoryImpl, $validationsRules = [];

    public function __construct(IProvidersRepository $providersRepositoryImpl)
    {
        $this->providersRepositoryImpl = $providersRepositoryImpl;
    }

    /**
     *
     * @param  App\Http\Requests\ProvidersRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(ProvidersRequest $request)
    {
        $providerExists = Providers::where($request->nif, '*');
        if ($providerExists) {
            return response()->json([
                "success" => false,
                "message" => "This Providers Already Exists"
            ], 400);
        }

        $url = 'https://api.gov.ao/consultarBI/v2/?bi=' . $request->nif;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $result = json_decode(curl_exec($ch));

        if (!$result) {
            return response()->json([
                "success" => false,
                "message" => "Invalid Company Nif"
            ], 400);
        }

        $newProvider = Providers::Create([
            'name' => $request->name,
            'nif' => $request->nif,
            'chiefNif' => $request->chiefNif,
            'averageDeliveryTime' => $request->averageDeliveryTime,
            'productToSupply' => $request->nif,
            'localization' => $request->localization,
            'observations' => $request->observations,
        ]);

        $newProvider->save();

        return json_encode([
            "success" => true,
            "message" => "Provider Register with Success.",
            "data" => $newProvider
        ], 201);
    }

    /**
     *
     * @param  App\Http\Requests\ProvidersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(ProvidersRequest $request, $id)
    {
        $provider = $this->providersRepositoryImpl->update($request->all(), $id);

        if (!$provider) {
            return response()->json(["error" => "Inexistent Provider"], 400);
        }

        return response()->json([
            "message" => "Provider Updated with success",
            "success" => true
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
        $provider = $this->providersRepositoryImpl->index($id);

        if (!$provider) {
            return response()->json([
                "success" => false,
                "message" => "Provider Not Exists",
            ], 400);
        }

        return response()->json([
            "success" => true,
            "message" => "Provider Values",
            "data" => $provider
        ], 200);
    }

    public function show()
    {
        $providers = $this->providersRepositoryImpl->show();
        return response()->json([
            "success" => true,
            "message" => "All Providers",
            "data" => $providers
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
        $provider = $this->providersRepositoryImpl->index($id);

        if (!$provider) {
            return response()->json([
                "success" => false,
                "message" => "Provider Not Exists",
            ], 400);
        }

        $removeProvider = $this->providersRepositoryImpl->delete($id);
        return response()->json([
            "success" => true,
            "message" => "Provider Destroyed with successfully",
            "data" => $removeProvider
        ], 200);
    }
}
