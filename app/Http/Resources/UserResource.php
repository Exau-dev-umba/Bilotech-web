<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=> $this->id,
            'nom'=> $this->name,
            'email'=> $this->email,
            'image'=> $this->image,
            'telephone'=> $this->telephone,
            'temp' => $this->temp,
            'date_created'=> $this->created_at,//\Carbon\Carbon::parse($this->created_at)->isoFormat('DD-MM-Y H:mm '),
            'date_updated'=> $this->updated_at//\Carbon\Carbon::parse($this->updated_at)->isoFormat('DD-MM-Y H:mm ')
        ];
        //return parent::toArray($request);
    }
}
