<?php

namespace App\Http\Controllers;

use App\Models\Episode;

class EpisodesController extends BaseController
{
    public function __construct()
    {
        $this->class = Episode::class;
    }

    public function searchForSerie(int $serieId)
    {
        $episodes = Episode::query()
            ->where(['series_id' => $serieId])
            ->get();

        return $episodes;
    }
}
