<?php

namespace App\Http\Requests\Api;

use App\Models\Participant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParticipantsRequest extends FormRequest
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
            'email'=> [
                'required',
                'email',
                Rule::unique('participants','email')->ignore($this->id)
            ],
            'nip'=> [
                'required',
                Rule::unique('participants','nip')->ignore($this->id)
            ],
            'phone_country_code' => [
                'required',
                'string'
            ],
            'phone' => [
                'required'
            ],
            'gender' => [
                'required',
                Rule::in(['ikhwan','akhwat'])
            ],
            'birth_date' => [
                'nullable',
                'date_format:Y-m-d'
            ],
            'status' => [
                'required',
                Rule::in(['active','inactive'])
            ],
            'billing_cycle' => [
                'required',
                'int'
            ],
            'classes' => [
                'nullable',
                'array'
            ],
            'classes.*' => [
                Rule::exists('classes','id')
            ]
        ];
    }

    public function persist(Participant $participant = null)
    {
        $participant = $participant ?? new Participant;

        $participant->name = $this->name;
        $participant->email = $this->email;
        $participant->nip = $this->nip;
        $participant->phone_country_code = $this->phone_country_code;
        $participant->phone = $this->phone;
        $participant->birth_date = $this->birth_date;
        $participant->unique_code = $this->unique_code;
        $participant->gender = $this->gender;
        $participant->status = $this->status;
        $participant->billing_cycle = $this->billing_cycle;

        $participant->save();

        if($this->filled('classes')) {
            $participant->classes()->sync($this->classes);
        }

        return $participant->fresh(['classes']);
    }
}
