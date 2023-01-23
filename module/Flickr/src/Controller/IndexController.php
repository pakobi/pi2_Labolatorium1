<?php

namespace Flickr\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Flickr\Model\Flickr;

class IndexController extends AbstractActionController
{
    public function __construct(private Flickr $flickr)
    {
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function searchAction()
    {
        $phrase = $this->params()->fromQuery('phrase');
        
        $ekspozycja = $this->flickr->szukajZdjecia($phrase);

        if (isset($ekspozycja->photos)){
            $view = new ViewModel(['phrase' => $phrase, 'ekspozycja' => $ekspozycja->photos]);
        }else{
            $view = new ViewModel(['phrase' => $phrase]);
        }

        return $view;

    }
    public function userAction()
    {
        $phrase = $this->params()->fromQuery('phrase');
        $ekspozycja = $this->flickr->szukajZdjeciaUzytkownika($phrase);
        if (isset($ekspozycja->photos)){
            $view = new ViewModel(['phrase' => $phrase, 'ekspozycja' => $ekspozycja->photos]);
        }else{
            $view = new ViewModel(['phrase' => $phrase]);
        }
        return $view;
    }
}

