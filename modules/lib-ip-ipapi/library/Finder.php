<?php
/**
 * Finder
 * @package lib-ip-ipapi
 * @version 0.0.1
 */

namespace LibIpIpapi\Library;

use LibCurl\Library\Curl;

class Finder
    implements 
        \LibIpLocator\Iface\Finder
{

    static function find(string $ip): ?object {
        if($ip === '127.0.0.1')
            return null;
        $apikey = \Mim::$app->config->libIpIpapi->apikey;

        $url = 'https://ipapi.co/'.$ip.'/json/';
        if($apikey)
            $url.= '?key=' . $apikey;

        $opts = [
            'url'       => $url,
            'method'    => 'GET',
            'headers'   => [
                'Accept'    => 'application/json'
            ],
            'agent'     => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:67.0) Gecko/20100101 Firefox/67.0'
        ];

        $result = Curl::fetch($opts);
        if(!$result || !is_object($result))
            return null;
        if(isset($result->error) || isset($result->reserved))
            return null;
        
        $continents = [
            'AF' => 'Africa',
            'AN' => 'Antarctica',
            'AS' => 'Asia',
            'EU' => 'Europe',
            'NA' => 'North America',
            'OC' => 'Oceania',
            'SA' => 'South America',
        ];

        return (object)[
            'city' => $result->city,
            'state' => (object)[
                'name' => $result->region,
                'code' => $result->region_code
            ],
            'country' => (object)[
                'name' => $result->country_name,
                'code' => $result->country
            ],
            'continent' => (object)[
                'name' => ($continents[$result->continent_code] ?? NULL),
                'code' => $result->continent_code
            ],
            'timezone' => $result->timezone
        ];
    }
}