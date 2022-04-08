<?php

namespace App\Http\Requests\Api;

use App\Models\Classes;
use Illuminate\Foundation\Http\FormRequest;

class ClassesRequest extends FormRequest
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
            'name' => ['required'],
            'price'=> ['required']
        ];
    }

    public function persist(Classes $classes=null)
    {
        $classes = $classes ?? new Classes;

        $classes->name = $this->name;
        $classes->period = $this->period;
        $classes->description = $this->description;
        $classes->price = $this->price;

        $classes->save();

        return $classes->fresh();
    }
}
