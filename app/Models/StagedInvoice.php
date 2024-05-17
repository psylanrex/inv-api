<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StagedInvoice extends Model
{
    use HasFactory;

    protected $table = 'inventory.StagedInvoice';

    /**
     * Relation to the Staged Invoice Items table each
     * staged invoice can have many items attached to it.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stagedInvoiceItems()
    {
        return $this->hasMany(StagedInvoiceItem::class);
    }
    
}
