<?php


namespace MyApp\Domain\User\Entities;


use MyApp\Core\ValueObjects\Uuid;

class User
{
    /** @var Uuid */
    private $id;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var string */
    private $email;

    /**
     * User constructor.
     * @param Uuid $id
     * @param string $username
     * @param string $password
     * @param string $email
     */
    public function __construct(Uuid $id, $username, $password, $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $this->passwordHashingFunction($password);
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $this->passwordHashingFunction($password);
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return Uuid
     */
    public function getId()
    {
        return $this->id;
    }

    private function passwordHashingFunction($password) {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }
}