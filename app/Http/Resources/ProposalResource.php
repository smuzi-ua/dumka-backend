<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Proposal */
class ProposalResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'title'      => $this->title,
            'body'       => $this->body,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id'    => $this->user_id,
            'school_id'  => $this->school_id,
        ];
    }
}
