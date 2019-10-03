<?php

class register
{
    private $Id;
    private $Mail;
    private $Password;
    private $VerifPassword;
    private $Admin;


    public function _construct()
    {

    }

    public function getId()
    {
        return $this->Id;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getPassword()
    {
        return $this->Password;
    }

    public function getVerifPassword()
    {
        return $this->VerifPassword;
    }



    /*------*/

    public function setId($id)
    {
        if (!is_string($id)) // S'il ne s'agit pas d'un string
        {
            trigger_error('La valeur entrée n\'est pas un string', E_USER_WARNING);
        }
        $this->Id = $id;

    }


    public function setMail($mail)
    {
        if (!is_string($mail)) // S'il ne s'agit pas d'un string
        {
            trigger_error('La valeur entrée n\'est pas un string', E_USER_WARNING);
        }
        $this->Mail = $mail;

    }

    public function setPassword($mdp)
    {
        if (!is_string($mdp)) // S'il ne s'agit pas d'un string
        {
            trigger_error('La valeur entrée n\'est pas un string', E_USER_WARNING);
        }
        if ($this->getVerifPassword() == $mdp)
            $this->Password = $mdp;
        else
            trigger_error('Le mot de passe ne correspond pas', E_USER_WARNING);

    }


}

?>