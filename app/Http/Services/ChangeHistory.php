<?php

namespace App\Http\Services;

use App\ChangeHistory as ChangeHistoryModel;
use Carbon\Carbon;
use Exception;

class ChangeHistory
{

    /**
     * @param $name string
     * @param $value string
     * @param $idUser int
     * @return bool
     * @throws Exception
     */
    public function create($name, $value, $idUser): bool
    {

        try {

            ChangeHistoryModel::insert([
                'name' => $name,
                'value' => $value,
                'id_user' => $idUser,
                'created_at' => Carbon::now()
            ]);

        } catch (Exception $ex) {
            throw $ex;
        }

        return true;

    }

    /**
     * @param $idUser int
     * @param $sort string
     * @param $name string
     * @return mixed
     * @throws Exception
     */
    public function getChangesByName($idUser, $sort = 'desc', $name = 'all')
    {

        try {

            $changesQuery = ChangeHistoryModel::where('id_user', '=', $idUser);

            if ($name != 'all') {
                $changesQuery->where('name', '=', $name);
            }

            $changes = $changesQuery->orderBy('created_at', $sort)->get();

        } catch (Exception $ex) {
            throw $ex;
        }

        return $changes;

    }

}