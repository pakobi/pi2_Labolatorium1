<?php

namespace Maps\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Form\Element\Submit;
use Maps\Form\GeopointForm;
use Maps\Model\Geopoint;

class IndexController extends AbstractActionController
{
    //private geopointForm $geopointForm;
    
    /**
     * IndexController constructor.
     * @param Geopoint $Geopoint
     */

    public function __construct(private Geopoint $Geopoint)
    {
        $this->geopoint = $Geopoint;
    }

    // public function indexAction()
    // {
    //     return new ViewModel();
    // }

    public function indexAction()
    {
        $returnArray = array();
        foreach ($this->geopoint->pobierzWszystko() as $result) {
            $returnArray[] = $result;
        }
        //dd($returnArray);
        return new ViewModel([
            'results' =>$this->geopoint->pobierzWszystko(),
        ]);
    }


    // public function pobierzAction()
    // {
    //     $viewModel = new ViewModel(['geopoint' => $this->geopoint->pobierzWszystko()]);
    //     dd($this->geopoint->toArray());
    //     $viewModel->setTemplate('maps/index/index.phtml');
    //     return $viewModel;
    // }

    public function dodajAction()
    {
        $Form = new GeopointForm(); 
        $this->form = $Form;
        $this->form->get('dodaj')->setValue(value:'Dodaj');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $this->form->setData($request->getPost());

            if ($this->form->isValid()) {

                $result = $this->geopoint->dodaj($request->getPost());
                
                if ($result == "NOK"){
                    $viewModel = new ViewModel(['form' => $this->form, "status" => "NOK"]);
                    return $viewModel;
                }

                return $this->redirect()->toRoute('maps');
            }
            
        }

        $viewModel = new ViewModel(['form' => $this->form, "status" => "OK"]);
        return $viewModel;
    }
}
