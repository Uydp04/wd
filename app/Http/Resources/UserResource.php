<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
        //trả ra toàn bộ dữ liệu
        // return [
        //     'id_bai_viet' => $this->id,
        //     'image' => $this->hinh_anh,
        //     'title' => $this->tieu_de,
        //     'content' => $this->noi_dung,

        // ];
        return parent::toArray($request);
    }
}
