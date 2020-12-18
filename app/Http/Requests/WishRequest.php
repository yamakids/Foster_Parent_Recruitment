<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WishRequest extends FormRequest
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
        return [
          'title' => 'required|max:20',
          'body' => 'required|max:1000',
          'user_id' => 'required|numeric',
          'image' => 'required|file|image|mimes:png,jpeg,jpg'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '20文字以内で入力してください',
            'title.max' => '20文字以内で入力してください',
            'body.required' => '1000文字以内で入力してください',
            'body.max' => '1000文字以内で入力してください',
            'user_id.required' => 'ログインしてください',
            'image.required' => '選択してください',
            'image.file' => 'ファイルを用意してください',
            'image.image' => '画像に限ります',
            'image.mimes' => '画像ファイル形式は、png,jpeg,JPGに限ります',
        ];
    }
}
