<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        
        return [
            "title" => ['required', 'min:2'],
            "content" => ['required', 'min:10', 'max:160'],
            "keyword" => ['required'],
            "country" => ['required'],
            "city" =>['required'] ,
            "price" => ['required', 'integer'],
            "devise" => ['required']
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "Créer" => false,
            "Echec" => true,
            "Message" => "Erreurs de création",
            "Listes d'erreurs" => $validator->errors()
        ]));
    }
}
