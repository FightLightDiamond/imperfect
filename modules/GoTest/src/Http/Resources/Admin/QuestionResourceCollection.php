<?php
/**
 * Created by PhpStorm.
 * Date: 8/29/19
 * Time: 5:48 PM
 */

namespace GoTest\Http\Resources\Admin;

use GoTest\Models\Question;
use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestionResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $currentPage = $this->currentPage();
        $perPage = $this->perPage();


        $items = $this->formatData(clone $this->collection);

        return [
            'status' => true,
            'total' => $this->total(),
            "last_page" => $this->lastPage(),
            'per_page' => $perPage,
            'current_page' => $currentPage,
            "next_page_url" => $this->nextPageUrl(),
            "prev_page_url" => $this->previousPageUrl(),
            "from" => $perPage * ($currentPage - 1) + 1,
            "to" => $perPage * ($currentPage - 1) + $this->count(),

            'data' => $items,
        ];
    }

    public function formatData($items)
    {
        $data = [];

        foreach ($items as $i => $item) {
            $data[$i] = $item->getAttributes();

            if($item->type !== Question::TRUE_FALSE_TYPE) {
                $data[$i]['replies'] = json_decode($item->replies, true);
            }
        }

        return $data;
    }
}
