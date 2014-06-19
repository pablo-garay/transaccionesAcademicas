<?php

namespace ZfcUser\Form;

use ZfcUser\Entity\UserInterface;
use ZfcUser\Form\Register;
use ZfcUser\Options\RegistrationOptionsInterface;
use ZfcUserAdmin\Options\UserEditOptionsInterface;
use Zend\Form\Form;
use Zend\Form\Element;
use RoleUserBridge\Service\User as RoleLinker;

class Edit extends Register
{
    /**
     * @var \ZfcUserAdmin\Options\UserEditOptionsInterface
     */
    protected $userEditOptions;
    protected $userEntity;
    protected $serviceManager;

    public function __construct($name = null, RegistrationOptionsInterface $registerOptions)
    {
        parent::__construct($name, $registerOptions);

        $this->remove('captcha');
        $this->remove('email');
        $this->remove('contrasena');
        $this->remove('contrasena_verify');


        

        $this->add(
            array(
                    'name' => 'nombres',
                    'type' => 'text',
                    'attributes' => array(
                            'placeholder' => 'Escriba el nombre...',
                            'required' => 'required',
                    ),
                    'options' => array(
                            'label' => 'Nombres',
                    ),
            )
        );

        $this->add(
            array(
                    'name' => 'apellidos',
                    'type' => 'text',
                    'attributes' => array(
                            'placeholder' => 'Escriba el apellido...',
                            'required' => 'required',
                    ),
                    'options' => array(
                            'label' => 'Apellidos',
                    ),
            )
        );

        $this->add(array(
            'name' => 'sexo',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                    'required' => 'required',
            ),
            'options' => array(
                    'label' => 'Sexo',
                    'value_options' => array(
                            'M' => 'Masculino',
                            'F' => 'Femenino',
                    ),
                ),
        ));

        $this->add(array(
                'name' => 'direccion',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                        'placeholder' => 'Escriba su dirección...',
                        'required' => 'required',
                ),
                'options' => array(
                        'label' => 'Dirección',
                ),
        ));

        $this->add(array(
                'name' => 'telefono',
                'options' => array(
                        'label' => 'Teléfono'
                ),
                'attributes' => array(
                        // Below: HTML5 way to specify that the input will be phone number
                        'type' => 'tel',
                        'placeholder' => 'Escriba su teléfono...',
                        'required' => 'required',
                        // Below: HTML5 way to specify the allowed characters
                        'pattern'  => '^[\d-/]+$'
                ),
        ));
        
        $this->get('submit')->setLabel('Editar')->setValue('Guardar');

        $this->add(array(
            'name' => 'userId',
            'attributes' => array(
                'type' => 'hidden'
            ),
        ));
    }

    public function setUser($userEntity)
    {
        $this->userEntity = $userEntity;
        $this->getEventManager()->trigger('userSet', $this, array('user' => $userEntity));
    }

    public function getUser()
    {
        return $this->userEntity;
    }

    public function populateFromUser(UserInterface $user)
    {
        foreach ($this->getElements() as $element) {
            /** @var $element \Zend\Form\Element */
            $elementName = $element->getName();
            if (strpos($elementName, 'contrasena') === 0) continue;

            $getter = $this->getAccessorName($elementName, false);
            if (method_exists($user, $getter)) $element->setValue(call_user_func(array($user, $getter)));
        }

        // foreach ($this->getUserEditOptions()->getEditFormElements() as $element) {
        //     $getter = $this->getAccessorName($element, false);
        //     $this->get($element)->setValue(call_user_func(array($user, $getter)));
        // }
        $this->get('userId')->setValue($user->getId());
    }

    protected function getAccessorName($property, $set = true)
    {
        $parts = explode('_', $property);
        array_walk($parts, function (&$val) {
            $val = ucfirst($val);
        });
        return (($set ? 'set' : 'get') . implode('', $parts));
    }

    public function setUserEditOptions(UserEditOptionsInterface $userEditOptions)
    {
        $this->userEditOptions = $userEditOptions;
        return $this;
    }

    public function getUserEditOptions()
    {
        return $this->userEditOptions;
    }

    public function setServiceManager($serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    public function getServiceManager()
    {
        return $this->serviceManager;
    }
}
