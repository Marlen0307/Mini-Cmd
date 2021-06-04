<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
        if ($this->email != $this->company->email){
            //if the email is changed we will check if the email is unique
            $emailRules = 'email|unique:App\Models\Company,email';
        }else{
            $emailRules = 'email';
        }
        return [
                 'name'=> 'required',
                 'email'=>$emailRules,
                 'logo'=> 'dimensions:min_width=100,min_height=100',
                 'website'=> 'max:255'
        ];
    }
}
