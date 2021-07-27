<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client_name' => $this->client_name,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'zip' => $this->zip,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'phone_no1' => $this->phone_no1,
            'phone_no2' => $this->phone_no2,
            'totalUser' => [
                "all" => $this->users_count,
                'active'=>$this->active_users_count,
                'inactive'=>$this->in_active_users_count,
            ],
            'start_validity' => $this->start_validity,
            'end_validity' => $this->end_validity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
