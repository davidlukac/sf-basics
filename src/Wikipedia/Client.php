<?php
/**
 * Created by PhpStorm.
 * User: davidlukac
 * Date: 02/06/16
 * Time: 12:04
 */

namespace Wikipedia;

class Client
{
    public function get($endpoint)
    {
        return json_decode(file_get_contents($endpoint))->query->search;
    }
}
