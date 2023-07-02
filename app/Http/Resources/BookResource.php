<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => Str::limit($this->name, 11),
            'slug' => $this->slug,
            'image' => $this->image,
            'sell_price' => $this->sell_price,
            'author' => new AuthorResource($this->whenLoaded('author')),
        ];
    }
}
