<?php

namespace Pckg\Center\Api\Helper;

use Pckg\Center\Api\Api;

trait CommunicatesWithCenter
{
    /**
     * @return Api
     */
    public function getCenterApi(): Api
    {
        $config = config('comms.center', []);

        return resolve(Api::class, [
            'endpoint' => $config['endpoint'],
            'apiKey' => $config['auth']['apiKey'],
        ]);
    }
}
