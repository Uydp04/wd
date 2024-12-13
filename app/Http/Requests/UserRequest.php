<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [];

        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()) {
            case 'POST':
                switch ($currentAction) {
                    case 'login': 
                        $rules = [
                            'email' => 'required',
                            'password' => 'required',
                        ];
                        break;
                    case 'register': 
                        $rules = [
                            'name' => 'required',
                            'email' => 'required|unique:users',
                            'password' => 'required',
                        ];
                        break;
                    default:
                        break;
                }
                break;
        }

        return $rules;
        
    }
    public function messages()
    {
        return [
            'name.required' => 'Bắt buộc phải điền tên',
            'email.required' => 'Bắt buộc phải điền email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Bắt buộc phải điền mật khẩu',
        ];
    }
}
