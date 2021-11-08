<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class IpStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'ip' => 'required|ip|unique:ips,ip',
        ];
    }

    /**
    * Get custom messages for validator errors.
    *
    * @return array
    */
    public function messages(): array
    {
        return [
            'ip.required' => 'Ip must not be empty.',
            'ip.ip' => 'Ip must be a valid Ip address format.',
            'ip.unique' => 'This Ip already exist in the database.',
        ];
    }
}
