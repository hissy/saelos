<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ActivityCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => array_column($this->collection->toArray(), 'resource'),
        ];
    }
}
