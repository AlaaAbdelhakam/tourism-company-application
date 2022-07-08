<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'age' => 'required|numeric|min:25|max:60',
            'driver_name' => 'required|unique:drivers,driver_name',

            'address' => 'required',
            
        ];
    }
    // public function messages(){
    //     return[
    //         'name.required'=>'الاسم مطلوب',
    //         'name.unique'=>'هذا الاسم موجود',
    //         'age.required'=>'العمر مطلوب',
    //         'address.required'=>'العنوان مطلوب',

    //     ];
    // }
}