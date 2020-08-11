<?php

namespace GoTest\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['replies'] = json_decode($data['replies'], true);
        return $data;
    }
}
