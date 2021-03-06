<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends ApiRequest
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
        switch($this->method()) {
            case 'POST':
                return [
                    'user_name' => ['required', 'max:20'],
                    'user_mail' => ['required', 'email', 'unique:users,user_mail'],
                    'user_password' => ['required']
                ];
            case 'PUT':
                $userId = Auth::user()->user_id;
                return [
                    'user_name' => ['required', 'max:20'],
                    'user_mail' => ['required', 'email', 'unique:users,user_mail,'.$userId.',user_id'],
                    'user_password' => ['present']
                ];
            default: break;
        }
    }
}
