<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeReques extends FormRequest
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
        if ($this->email != $this->employee->email){
            $emailRules = 'email|unique:App\Models\Employee,email';
        }else{
            $emailRules = 'email';
        }
        return [
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=> $emailRules,
            'company'=> 'required'
        ];
    }
}
