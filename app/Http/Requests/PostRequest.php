<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|nullable|unique:posts',
        ];
    }
    public function prepareForValidation()
    {
        $input = $this->all();
        $input['is_done'] = filter_var(array_get($input, 'is_done'), FILTER_VALIDATE_BOOLEAN);
        $this->replace($input);
    }
}
