<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'genre' => $this->genre,
            'release_date' => $this->release_date,
            'director' => $this->director,
            'running_time' => $this->running_time,
            'rating' => $this->rating
        ];
    }

    public function with ($request)
    {
        return [
            'project' => 'For SMG test',
            'version' => '1.0.0',
            'author' => 'J-M',
            'gitHub' => url('https://github.com/shoothaha?tab=repositories')
        ];
    }
}
