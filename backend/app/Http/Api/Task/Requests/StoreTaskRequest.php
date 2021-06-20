<?php

namespace App\Http\Api\Task\Requests;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
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
            'title'     => 'required',
            'status'=>'required|exists:in'.['active','done'],
            'category_id' => 'required | exists:categories,id',
        ];
    }
}
