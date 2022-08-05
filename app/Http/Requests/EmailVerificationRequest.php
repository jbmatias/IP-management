<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Events\Verified;

class EmailVerificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function authorize()
    {
        if (! hash_equals((string) $this->route('id'),
                          (string) $this->user->find($this->route('id'))->getKey())) {
            return false;
        }

        if (! hash_equals((string) $this->route('hash'),
                          sha1($this->user->find($this->route('id'))->getEmailForVerification()))) {
            return false;
        }

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
            //
        ];
    }

    /**
     * Fulfill the email verification request.
     *
     * @return void
     */
    public function fulfill()
    {
        if (! $this->user->find($this->route('id'))->hasVerifiedEmail()) {
            $this->user->find($this->route('id'))->markEmailAsVerified();

            event(new Verified($this->user->find($this->route('id'))));
        }
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        return $validator;
    }
}
