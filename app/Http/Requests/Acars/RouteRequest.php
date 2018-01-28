<?php

namespace App\Http\Requests\Acars;

use App\Models\Pirep;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RouteRequest
 * @package App\Http\Requests\Acars
 */
class RouteRequest extends FormRequest
{
    public function authorize()
    {
        $pirep = Pirep::findOrFail($this->route('pirep_id'), ['user_id']);
        return $pirep->user_id === Auth::id();
    }

    public function rules()
    {
        $rules = [
            'route' => 'required|array',
            'route.*.name' => 'required',
            'route.*.order' => 'required|int',
            'route.*.nav_type' => 'nullable|int',
            'route.*.lat' => 'required|numeric',
            'route.*.lon' => 'required|numeric',
        ];

        return $rules;
    }
}
