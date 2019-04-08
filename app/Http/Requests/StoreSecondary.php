<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSecondary extends FormRequest
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
            'name' => 'required|max:50|min:5',
            'description' => 'required|max:191|min:5',
            'pitch_id' => 'required',
            'type_id' => 'nullable',
            'image' => 'nullable|image',
            'active' => 'nullable'
        ];
    }
}
