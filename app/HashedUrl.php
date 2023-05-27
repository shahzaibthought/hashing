<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class HashedUrl extends Model
{
    /**
     * @return int
     */
    public function id() : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function url() : string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function hash() : string
    {
        return $this->hash;
    }

    /**
     * @return int
     */
    public function clicks() : int
    {
        return $this->clicks;
    }

    /**
     * @return Carbon
     */
    public function createdAt() : Carbon
    {
        return $this->created_at;
    }

    /**
     * @return Carbon
     */
    public function updatedAt() : Carbon
    {
        return $this->updated_at;
    }

    /**
     * @param string $url
     *
     * @return self
     */
    public function setUrl(string $url) : self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param string $hash
     *
     * @return self
     */
    public function setHash(string $hash) : self
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * @param int $clicks
     *
     * @return self
     */
    public function setClicks(int $clicks) : self
    {
        $this->clicks = $clicks;

        return $this;
    }

    /**
     * @param Builder $query
     * @param string $url
     *
     * @return Builder
     */
    public function scopeByUrl(Builder $query, string $url) : Builder
    {
        return $query->where('url', $url);
    }

    /**
     * @param Builder $query
     * @param string $hash
     *
     * @return Builder
     */
    public function scopeByHash(Builder $query, string $hash) : Builder
    {
        return $query->where('hash', $hash);
    }
}
