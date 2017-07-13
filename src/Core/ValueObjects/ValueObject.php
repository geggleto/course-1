<?php


namespace MyApp\Core\ValueObjects;


interface ValueObject
{
    /**
     * @param ValueObject $object
     *
     * @return boolean
     */
    public function equals(ValueObject $object);
    /**
     * @return string
     */
    public function __toString();
}