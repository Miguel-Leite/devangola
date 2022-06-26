<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
  /**
   * Determinar se utilizador está autorizado para efetuar requisição.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Validar requisição.
   *
   * @return array
   */
  public function rules()
  {
    return [];
  }
}
