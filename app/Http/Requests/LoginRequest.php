<?php

namespace App\Http\Requests;

use App\Http\Resources\AuthUserResource;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            if (!$this->user()->hasVerifiedEmail()) {
                abort(response()->json(['error' => 'Your email account is not verified.'], 401));
            }
            return true;
        }
        abort(response()->json(['error' => 'Invalid Username and Password.'], 401));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email', 'exists:users'],
            'password' => ['required', 'string', 'min:5'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {

        if (Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            return $this->token();
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }


    public function token()
    {
        return array_merge(
            ['token' => $this->user()->createToken('ip-manager')->accessToken],
            collect(new AuthUserResource(auth()->user()))->toArray()
        );
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
