<?php

namespace Grundmanis\Laracms\Modules\Pages\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PageRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('laracms')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        foreach(\LocaleAlias::getLocales() as $locale)
        {
            $rules[$locale . '.text'] = 'required';
            $rules[$locale . '.url'] = 'required';
        }

        return $rules;
    }

    public function attributes()
    {
        $fields = [];
        foreach(\LocaleAlias::getLocales() as $locale)
        {
            $fields[$locale . '.text'] = $locale .' text';
            $fields[$locale . '.url'] = $locale .' url';
        }

        return $fields;
    }
}
