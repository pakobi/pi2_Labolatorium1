<?php

namespace Flickr\Model;

use Laminas\Db\Adapter as DbAdapter;
use Laminas\Db\Sql\Sql;
use Laminas\Http\Client;
use Laminas\Json\Json;

class Flickr
{
    public function szukajZdjecia($phrase){
        $tekst = urlencode($phrase);
        $client = new Client(
            "https://www.flickr.com/services/rest/?method=flickr.photos.search&text=$tekst&api_key=9b04ce39309e4ec4a4c82aa49b65bf6c&format=json&sort=relevance&extras=original_format",
            [
                'maxredirects' => 0,
                'timeout'      => 30,
            ]
        );
        $client->setHeaders(['Accept-Encoding' => 'identity']);

        $response = $client->send();

        $trim_response = rtrim(trim($response->getBody(), "jsonFlickrApi("), ")");
        $json = Json::decode($trim_response);
        return $json;
    }

    public function szukajZdjeciaUzytkownika($phrase){

        $nazwa = urlencode($phrase);
        $uid = $this->wyszukajUsera($nazwa);
        $client = new Client(
            "https://www.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&user_id=$uid&api_key=9b04ce39309e4ec4a4c82aa49b65bf6c&format=json",
            [
                'maxredirects' => 0,
                'timeout'      => 30,
            ]
        );
        $client->setHeaders(['Accept-Encoding' => 'identity']);
        $response = $client->send();

        $trim_response = rtrim(trim($response->getBody(), "jsonFlickrApi("), ")");
        $json = Json::decode($trim_response);

        return $json;

    }

    public function wyszukajUsera($name)
    {
        $tekst = urlencode($name);
        $client = new Client(
            "https://www.flickr.com/services/rest/?method=flickr.people.findByUsername&username=$tekst&api_key=9b04ce39309e4ec4a4c82aa49b65bf6c&format=json",
            [
                'maxredirects' => 0,
                'timeout' => 30,
            ]
        );
        $client->setHeaders(['Accept-Encoding' => 'identity']);
        $response = $client->send();

        $trim_response = rtrim(trim($response->getBody(), "jsonFlickrApi("), ")");
        $json = Json::decode($trim_response);

        if($json->stat == "ok"){
            $uid = $json->user->nsid;
            return $uid;
        }
        return "NOK";
    }


}