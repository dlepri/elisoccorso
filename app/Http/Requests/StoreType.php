<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreType extends FormRequest
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
        if ($this->type) {
            return [
                'name' => 'required|max:50|min:5',
                'icon' => 'nullable|mimes:png'
            ];
        }
        return [
            'name' => 'required|max:50|min:5',
            'icon' => 'required|mimes:png'
        ];
    }
}
