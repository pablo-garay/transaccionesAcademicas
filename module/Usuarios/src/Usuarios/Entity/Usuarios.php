<?php
namespace Usuarios\Entity;
 
use ZfcUser\Entity\UserInterface;
 
class Usuarios implements UserInterface
{
	 /**
     * @var int
     */
    protected $usuario;

    /**
     * @var string
     */
     protected $username;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
     protected $displayName;

    /**
     * @var string
     */
    protected $contrasena;

    /**
     * @var int
     */
    protected $estado_cuenta;

    /**
     * @var int
     */
    protected $sexo;

//     /**
//      * @var date
//      */
//     protected $fecha_nacimiento;

    /**
     * @var string
     */
    protected $direccion;

    /**
     * @var string
     */
    protected $telefono;

     /**
      * @var string
      */
      protected $tipo_de_documento;

      /**
       * @var int
       */
      protected $numero_de_documento;
      
      /**
       * @var string
       */
      protected $origen_de_documento;

    /**
     * @var string
     */
    protected $nombres;

    /**
     * @var string
     */
    protected $apellidos;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->usuario;
    }

    /**
     * Set id.
     *
     * @param int $id
     * @return UserInterface
     */
    public function setId($id)
    {
        $this->usuario = (int) $id;
        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username.
     *
     * @param string $username
     * @return UserInterface
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email.
     *
     * @param string $email
     * @return UserInterface
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get displayName.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set displayName.
     *
     * @param string $displayName
     * @return UserInterface
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->contrasena;
    }

    /**
     * Set password.
     *
     * @param string $password
     * @return UserInterface
     */
    public function setPassword($password)
    {
        $this->contrasena = $password;
        return $this;
    }

    /**
     * Get state.
     *
     * @return int
     */
    public function getState()
    {
        return $this->estado_cuenta;
    }

    /**
     * Set state.
     *
     * @param int $state
     * @return UserInterface
     */
    public function setState($state)
    {
        $this->estado_cuenta = $state;
        return $this;
    }

    /**
     * Get sexo.
     *
     * @return int
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set sexo.
     *
     * @param int $sexo
     * @return UserInterface
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
        return $this;
    }

//     /**
//      * Get fecha nacimiento.
//      *
//      * @return date
//      */
//     public function getFecha_nacimiento()
//     {
//         return $this->fecha_nacimiento;
//     }

//     /**
//      * Set fecha nacimiento.
//      *
//      * @param date $fecha_nacimiento
//      * @return UserInterface
//      */
//     public function setFecha_nacimiento($fecha_nacimiento)
//     {
//         $this->fecha_nacimiento = $fecha_nacimiento;
//         return $this;
//     }

    /**
     * Get direccion.
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set direccion.
     *
     * @param string $direccion
     * @return UserInterface
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
        return $this;
    }

    /**
     * Get telefono.
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set telefono.
     *
     * @param string $telefono
     * @return UserInterface
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
        return $this;
    }

    /**
     * Get tipoDeDocumento.
     *
     * @return string
     */
    public function getTipoDeDocumento()
    {
        return $this->tipoDeDocumento;
    }

    /**
     * Set tipoDeDocumento.
     *
     * @param string $tipoDeDocumento
     * @return UserInterface
     */
    public function setTipoDeDocumento($tipoDeDocumento)
    {
        $this->tipoDeDocumento = $tipoDeDocumento;
        return $this;
    }

    /**
     * Get numeroDeDocumento.
     *
     * @return int
     */
    public function getNumeroDeDocumento()
    {
        return $this->numeroDeDocumento;
    }

    /**
     * Set numeroDeDocumento.
     *
     * @param int $numeroDeDocumento
     * @return UserInterface
     */
    public function setNumeroDeDocumento($numeroDeDocumento)
    {
        $this->numeroDeDocumento = $numeroDeDocumento;
        return $this;
    }
    
    /**
     * Get OrigenDeDocumento.
     *
     * @return string
     */
    public function getOrigenDeDocumento()
    {
    	return $this->origenDeDocumento;
    }
    
    /**
     * Set OrigenDeDocumento.
     *
     * @param string $origenDeDocumento
     * @return UserInterface
     */
    public function setOrigenDeDocumento($origenDeDocumento)
    {
    	$this->origenDeDocumento = $origenDeDocumento;
    	return $this;
    }

    /**
     * Get nombres.
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set nombres.
     *
     * @param string $nombres
     * @return UserInterface
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
        return $this;
    }

    /**
     * Get apellidos.
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set apellidos.
     *
     * @param string $apellidos
     * @return UserInterface
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
        return $this;
    }
}