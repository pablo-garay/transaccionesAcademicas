<?php

namespace ZfcUser\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;

class Base extends ProvidesEventsForm
{
    public function __construct()
    {
        parent::__construct();

        $this->add(array(
            'name' => 'username',
            'options' => array(
                'label' => 'Username',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));

        // This is how we define the "email" element
       $this->add(array(
            'name' => 'email', // the unique name of the element in the form.
                                //Ex: <input name="..."
            'type' => 'Zend\Form\Element\Email',
// The above must be valid Zend Form element.
// You can also use short names as “email” instead of “Zend\Form\Element\Email
            'options' => array(
                // This is list of options that we can add to the element.
                'label' => 'Email:'
                // Label is the text that should who before the form field
            ),
            'attributes' => array(
            // These are the attributes that are passed directly to the HTML element
                'type' => 'email', // Ex: <input type="email"
                'required' => 'required', // 'required' => true, // Ex: <input required="true"
                'placeholder' => 'Su dirección de email...', // HTM5 placeholder attribute
            )
        ));

        $this->add(array(
            'name' => 'display_name',
            'options' => array(
                'label' => 'Display Name',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));
        
        $this->add(array(
        		'name' => 'contrasena',
        		'type' => 'Zend\Form\Element\Password',
        		'attributes' => array(
        				'placeholder' => 'Indique contraseña aquí...',
        				'required' => 'required',
        		),
        		'options' => array(
        				'label' => 'Contraseña',
        		),
        ),
            array (
						'priority' => -90,
		));
        
        $this->add(array(
        		'name' => 'contrasena_verify',
        		'type' => 'Zend\Form\Element\Password',
        		'attributes' => array(
        				'placeholder' => 'Confirme contraseña aquí...',
        				'required' => 'required',
        		),
        		'options' => array(
        				'label' => 'Verifique contraseña',
        		),
        ),
            array (
						'priority' => -95,
		));

        if ($this->getRegistrationOptions()->getUseRegistrationFormCaptcha()) {
            $this->add(array(
                'name' => 'captcha',
                'type' => 'Zend\Form\Element\Captcha',
                'options' => array(
                    'label' => 'Please type the following text',
                    'captcha' => $this->getRegistrationOptions()->getFormCaptchaOptions(),
                ),
            ));
        }

        // This is the special code that protects our form beign submitted from automated scripts
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));

        // This is the submit button
        $this->add(array(
        		'name' => 'submit',
        		'type' => 'Zend\Form\Element\Submit',
        		'attributes' => array(
        				'value' => 'Registrarse',
        				'required' => 'false',
        		),
        ),
        array (
			'priority' => -100,
		));

        $this->add(array(
            'name' => 'userId',
            'type' => 'Zend\Form\Element\Hidden',
            'attributes' => array(
                'type' => 'hidden'
            ),
        ));

        // @TODO: Fix this... getValidator() is a protected method.
        //$csrf = new Element\Csrf('csrf');
        //$csrf->getValidator()->setTimeout($this->getRegistrationOptions()->getUserFormTimeout());
        //$this->add($csrf);
    }
}
