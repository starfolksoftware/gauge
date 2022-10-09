<?php

namespace StarfolkSoftware\Gauge;

trait TeamHasReviews
{
    /**
     * Get the reviews associated with the team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Gauge::reviewModel(), 'team_id');
    }
}