<?php
/**
 * Created by PhpStorm.
 * User: Marek
 * Date: 01.05.2018
 * Time: 10:19
 */

namespace App\Helpers;


class Status extends BaseName
{

    const LOST = [
        'key' => 'LOST',
        'name' => 'Zaginiony'
    ];

    const FOUND = [
        'key' => 'FOUND',
        'name' => 'Znaleziony'
    ];

}