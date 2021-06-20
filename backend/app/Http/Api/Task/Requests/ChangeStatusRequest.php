<?php

namespace App\Http\Api\Task\Requests;


use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusRequest extends FormRequest
{
    use HandlesAuthorization;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return Auth::user()->level === 5;
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
            'status'=>'required|in:'. implode(',', ['Done','Active']),
        ];
    }
}
