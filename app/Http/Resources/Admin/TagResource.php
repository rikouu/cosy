<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;

class TagResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
