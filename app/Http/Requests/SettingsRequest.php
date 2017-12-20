<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class SettingsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->page) {
            case 1:
                return [
                    'app_name' => 'bail|required|max:255',
                    'app_url' => 'bail|required|max:255',
                    'locale' => [
                        'bail',
                        'required',
                        Rule::in(array_keys (locales())),
                    ]
                ];
             case 4:
                 return [
                     'db_connection' => 'bail|required|in:mysql,sqlite,pgsql',
                     'db_host' => ['bail', 'required', 'regex:/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/'],
                     'db_port' => 'numeric',
                     'db_database' => 'bail|required|string|max:100',
                     'db_username' => 'bail|required|string|max:100',
                     'db_password' => 'max:100',
                 ];
            case 5:
                return [
                    'mail_from_address' => 'bail|email|max:100',
                    'mail_from_name' => 'bail|string|max:100',
                    'mail_driver' =>'bail|required|in:smtp,mail',
                    'mail_host' => 'nullable|required_if:mail_driver,smtp|string|max:100',
                    'mail_port' => 'nullable|required_if:mail_driver,smtp|numeric',
                    'mail_username' => 'nullable|required_if:mail_driver,smtp|string|max:100',
                    'mail_password' => 'nullable|required_if:mail_driver,smtp|max:100',
                    'mail_encryption' => 'nullable|required_if:mail_driver,smtp|alpha|max:20',
                ];
            default:
                return[];
        }
    }
}
