<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('admin', $this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name'=> 'required',
            'email'=>'email|unique:App\Models\Company,email',
            'logo'=> 'required|dimensions:min_width=100,min_height=100',
            'website'=> 'max:255'
        ];
    }
}
