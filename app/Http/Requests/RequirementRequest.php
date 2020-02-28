<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequirementRequest extends FormRequest
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
            return  [

                      "title"                        => "required|string|min:3|max:60",
                      "vacancy_no"                   => "required|digits_between:1,99",
                      "duration"                     => "required|string|min:1|max:10",
                      "experience"                   => "required|string|min:1|max:20",
                      "description"                  => "required|string|min:1|max:1000",
                      
                      "submission_date"              => "nullable|date_format:m-d-Y",
                      "location"                     => "nullable|string|min:2|max:60",
                      "sal_from"                     => "nullable|string|min:1|max:15",
                      "sal_to"                       => "nullable|string|min:1|max:15",
                      "start_date"                   => "nullable|date_format:m-d-Y",
                      "reporting_name"               => "nullable|string|min:2|max:60",
                      "reporting_desg"               => "nullable|string|min:2|max:60",
                      "reporting_contact"            => "nullable|digits_between:4,16",
                      "reporting_email"              => "nullable|email",
                      "notice_period"                => "nullable|string|min:1|max:60",
                      "lead_submit_date"             => "nullable|date_format:m-d-Y|before:submission_date",

                      //"assign_to"                   => "required",
                      //"priority"                    => "required",
                      //"need_by_no"                  => "required",
                      //"need_by_type"                => "required",
                      //"extendable"                  => "required",
                      //"interview_mode"              => "required",
                      //"travelling"                  => "required",
                      //"local_driving_license"       => "required",
                      //"local_availability"          => "required",
                      //"local_exp"                   => "required",
                      //"leave_sal"                   => "required",

                     
                    ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Position Title is required',
            'vacancy_no.required'  => 'Number of Vacancy field is required',
            'duration.required'  => 'Contract Duration field is required',
            'experience.required'  => 'Years Of Experience field is required',
            'description.required'  => 'Job Description field is required',
        ];
    }
}
