<?php

namespace App\Http\Requests;

use App\Http\Controllers\Service;
use Illuminate\Foundation\Http\FormRequest; // extends Request

class PruebaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//$this->headers->get('x-api-key') === 'authorized';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Service $service)
    {
        $collection = collect($service->consulta());
        $list = $collection->pluck('id')
            ->implode(',');
        //dd($list->implode(','));
        return [
            'name' => 'required|string',
            // el id (entero), y ser de los Ids del catalogo de procedencia de Kuspit
            'procedencia' => 'required|integer|in:'.$list
            //'procedencia' => ['required','integer', Rule::in($list)],
        ];
    }
}
