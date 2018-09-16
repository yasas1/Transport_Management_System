<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->canRequestJourney();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vehical_id' => 'required',
            'time_range' => 'required',
            'number_of_persons' => 'required',
            'expected_distance' => 'required',
            'divisional_head_id' => 'required',
            'purpose' => 'required', 
            'funds_allocated_from_id' => 'required'
        ];
    }
}
