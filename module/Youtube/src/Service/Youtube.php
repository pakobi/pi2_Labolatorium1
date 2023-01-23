<?php

namespace Youtube\Service;

use Google\Service\YouTube as GoogleYouTube;

class Youtube
{
    const DEV_KEY = 'AIzaSyB_s-LXrbjdnWghWb_xHaJ8UsEMYVO0YZw';
    //               AIzaSyAHX3BvRbr-yzH1Qw50mJvodhVn5CRKOsk moj klucz

    /**
     * @var \GoogleYouTube
     */
    private $youtube;

    public function __construct()
    {
        $client = new \Google\Client();
        $client->setDeveloperKey(self::DEV_KEY);

        $this->youtube = new GoogleYouTube($client);
    }

    public function getMostPopular($pageToken)
    {
        try {
            $films = $this->youtube->videos->listVideos('id, snippet, statistics', ['chart' => 'mostpopular', 'pageToken' => $pageToken]);
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $films;
    }

    public function search($phrase, $pageToken)
    {
        $filmIds = [];

        try {
            $results = $this->youtube->search->listSearch('id', ['type' => 'video', 'q' => $phrase, 'pageToken' => $pageToken]);

            /** @var \Google_Service_YouTube_SearchResult $r */
            foreach ($results as $r) {
                $filmIds[] = $r->getId()->getVideoId();
            }

            $films = $this->youtube->videos->listVideos('id, snippet, statistics', ['id' => implode(', ', $filmIds)]);
            $films->nextPageToken = $results->nextPageToken;
            $films->prevPageToken = $results->prevPageToken;
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $films;
    }

    public function getComments($id)
    {
        $comments = $this->youtube->commentThreads->listCommentThreads('snippet', ['videoId' => $id]);
        //dd($comments);
        return $comments;
    }
}
