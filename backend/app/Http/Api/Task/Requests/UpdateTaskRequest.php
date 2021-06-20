<?php

namespace App\Http\Api\Task\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UpdateTaskRequest extends FormRequest
{
    use HandlesAuthorization;

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
        return [
            'title'     => 'required',
            'description'=>'required',
            'category_id' => 'required | exists:categories,id',
        ];
    }
}
