<?php

/**
 * Application user model
 *
 * Hold values for a user and encapsulate domain logic
 *
 * @package Demo Application
 * @author Devis Lucato <devis@ibuildings.com>
 * @copyright Ibuildings UK
 * @date November 2010
 */

class Application_Model_User
{
    protected $_id;
    protected $_username;
    protected $_password;
    protected $_email;
    protected $_name;

    /**
     * Rich constructor
     * @param array $data
     */
    public function __construct(array $data = array())
    {
        if (!empty($data)) {
            if (isset($data['id']))
                $this->setId($data['id']);

            if (isset($data['username']))
                $this->setUsername($data['username']);

            if (isset($data['password']))
                $this->setPassword($data['password']);

            if (isset($data['email']))
                $this->setEmail($data['email']);

            if (isset($data['name']))
                $this->setName($data['name']);
        }
    }

    /**
     * Array adapter
     * @return array
     */
    public function toArray()
    {
        return array(
            'id'       => $this->getId(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'email'    => $this->getEmail(),
            'name'     => $this->getName(),
        );
    }

    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setUsername($username)
    {
        $this->_username = $username;
        return $this;
    }

    public function getUsername()
    {
        return $this->_username;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }

    /* domain logic, i.e. validation ... */
}