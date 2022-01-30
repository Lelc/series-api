<?php

namespace App\Http\Controllers;

use App\Models\Episode;

/**
 * EpisodesController
 */
class EpisodesController extends BaseController
{
    public function __construct()
    {
        $this->class = Episode::class;
    }

    /**
     * Search for series
     *
     * @param int $serieId
     *
     * @return \Illuminate\Database\Eloquent\Collection
     *
     */
    public function searchForSerie(int $serieId)
    {
        $episodes = Episode::query()
            ->where(['series_id' => $serieId])
            ->get();

        return $episodes;
    }
}
