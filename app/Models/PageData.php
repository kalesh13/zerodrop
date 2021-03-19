<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageData extends PropertyModel
{
    use HasFactory;

    /**
     * Returns the page to which this page data belongs to.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
