<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateDriverRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->canCreateDriver();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title_id'=>'required',
            'firstname'=>'required',
            'surname'=>'required',
            'nic'=>'required|size:10',
            'licence_no'=>'required',
            'mobile'=>'required|size:10',
        ];
    }

    public function messages()
    {
        return [
            'title_id.required'=>'Driver title is required.',
            'nic.min'=>'NIC must have Size 10 input',
            // 'nic.max'=>'NIC must have length 10 input',
                       
        ];
    }
}
