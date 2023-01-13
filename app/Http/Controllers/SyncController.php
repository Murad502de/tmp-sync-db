<?php

namespace App\Http\Controllers;

use App\Models\Services\amoCRM;
use App\Services\amoAPI\amoAPIHub;
use Illuminate\Http\Response;

class SyncController extends Controller
{
    private static $AMO_API = null;

    public function handle()
    {
        echo "SyncController/handle<br>";

        self::$AMO_API = new amoAPIHub(amoCRM::getAuthData());

        $lead = self::fetchLeadById(29498202);

        echo "<pre>";
        print_r($lead);
        echo "</pre>";

        return;
    }

    /* FETCH-METHODS */
    public static function fetchLeadById(int $id): ?array
    {
        $findLeadByIdResponse = self::$AMO_API->findLeadById($id);

        if ($findLeadByIdResponse['code'] !== Response::HTTP_OK) {
            echo 'lead not found by id: ' . $id . '<br>';

            return null;
        }

        return $findLeadByIdResponse['body'];
    }
}
