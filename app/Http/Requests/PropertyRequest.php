<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Property;
class PropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'property_title' => 'required | max:255',
            'property_address' => 'required | max:255',
        ];
    }
}
