<?php

namespace App;

trait Searchable
{
    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    public function scopeFilterByCountries($query, $countries)
    {
        if ($countries && is_array($countries)) {
            $query->whereHas('country', function ($query) use ($countries) {
                $query->whereIn('code', $countries);
            });
        }

        return $query;
    }
}
