<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            
            'access_token' => $this->createToken(config('app.name') . '.api.v1')->accessToken,
            'full_name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'update_at' => $this->updated_at,
        ];
    }
}
