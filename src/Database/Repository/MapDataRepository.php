<?php

namespace AvoRed\Framework\Database\Repository;

use App\Models\MapData;
use AvoRed\Framework\Database\Contracts\MapDataModelInterface;
use AvoRed\Framework\Database\Traits\FilterTrait;

class MapDataRepository extends BaseRepository implements MapDataModelInterface
{
    use FilterTrait;

    /**
     * @var GroupChat
     */
    protected $model;

    /**
     * Construct for the Produdct Repository
     *
     */
    public function __construct()
    {
        $this->model = new MapData();
    }


    /**
     * @return GroupChat
     */
    public function model()
    {
        return $this->model;
    }

    public function list($type)
    {
        return $this->model::where('map_data_type', $type)->paginate();
    }
}
