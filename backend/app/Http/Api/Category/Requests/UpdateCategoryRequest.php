<?php

namespace App\Http\Api\Task\Requests;

use App\Http\Request;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UpdateCategoryRequest extends Request
{
    use HandlesAuthorization;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return Auth::user()->level === 5;
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
            'name'     => 'required',
        ];
    }
}
