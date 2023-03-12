<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    use HasFactory;

    public function toArray()
    {
        return [
            'id' => $this->id,
            'version' => $this->version,
            'public_key' => $this->public_key,
            'private_key' => $this->private_key,
            'bot_id' => $this->bot_id,
            'category_id' => $this->category_id,
            'percent' => $this->percent,
            'api_key' => $this->api_key,
        ];
    }
}
