<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DictionaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'word_eng' => $this->word_eng,
            'word_ukr' => $this->word_ukr,
            'example_sentences' => $this->example_sentences,
            'image' => $this->image
        ];
    }
}
