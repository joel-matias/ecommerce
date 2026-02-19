<?php

namespace App\Observers;

use App\Models\Cover;

class CoverOserver
{
    public function creating(Cover $cover)
    {
        $cover->order = Cover::max('order') + 1;
    }
}
