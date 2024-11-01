<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',  
            'title' => 'required|string|max:255',              
            'description' => 'nullable|string|max:500',        
            'text' => 'required|string',                      
            'image_path' => 'nullable|mimes:jpeg,jpg,png,gif|max:2048',        
            'likes' => 'nullable|integer|min:0',               
            'dislikes' => 'nullable|integer|min:0',         
            'number_view' => 'nullable|integer|min:0',  
        ];
    }
    
}
