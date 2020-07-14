<?php

namespace App\Traits;

trait HasIdentifier
{
    /**
     * Initialize the trait.
     *
     * @return void
     */
    public function initializeHasIdentifier()
    {
        $this->append('identifier');
    }

    /**
     * Get the profile's encrypted identifier.
     *
     * @return string
     */
    public function getIdentifierAttribute()
    {
        return encrypt(get_class($this).':'.$this->id);
    }
}
