<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
            // Note: For production, you would add reCAPTCHA validation here
            // 'g-recaptcha-response' => ['required', 'captcha'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => __('messages.forms.required'),
            'email.required' => __('messages.forms.required'),
            'email.email' => __('messages.forms.invalid_email'),
            'subject.required' => __('messages.forms.required'),
            'message.required' => __('messages.forms.required'),
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => __('messages.contact.name'),
            'email' => __('messages.contact.email'),
            'phone' => __('messages.contact.phone'),
            'subject' => __('messages.contact.subject'),
            'message' => __('messages.contact.message'),
        ];
    }
}
