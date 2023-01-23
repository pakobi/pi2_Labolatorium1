<?php

namespace Maps\Form;

use Laminas\Form\Form;
use Laminas\InputFilter\InputFilterProviderInterface;
use Maps\Model\Geopoint;

class GeopointForm extends Form implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct();

        $this->setAttributes(['method' => 'post', 'class' => 'form']);
        $this->add([
            'name' => 'adresZbiorczy',
            'type' => 'Text',
            'options' => [
                'label' => 'Adres',
            ],
            'attributes' => ['class' => 'form-control'],
        ]);
        $this->add([
            'name' => 'opisPunktu',
            'type' => 'Text',
            'options' => [
                'label' => 'Opis',
            ],
            'attributes' => ['class' => 'form-control'],
        ]);
        $this->add([
            'name' => 'dodaj',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Dodaj',
                'class' => 'btn btn-primary',
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return
        [
            [
                'name' => 'adresZbiorczy',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [],
            ],
            [
                'name' => 'opisPunktu',
                'required' => true,
                'filters' => [
                        ['name' => 'StripTags'],
                        ['name' => 'StringTrim'],
                ],
                'validators' => [],
            ],

        ];
    }
}