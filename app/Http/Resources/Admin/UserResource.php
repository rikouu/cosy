<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;

class UserResource extends Resource
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
