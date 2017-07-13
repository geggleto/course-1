<?php

namespace MyApp\Core\ValueObjects;


use Ramsey\Uuid\Uuid as BaseUuid;

/**
 * Class Uuid
 *
 */
class Uuid implements ValueObject
{
    /**
     * @var string
     */
    private $value;
    /**
     * @param null|string $value
     * @throws \InvalidArgumentException
     */
    public function __construct($value = null)
    {
        if ($value !== null)
        {
            $pattern = '/'.BaseUuid::VALID_PATTERN.'/';
            if (! \preg_match($pattern, $value))
            {
                throw new \InvalidArgumentException("{$value} is not a valid UUID");
            }
            $uuid_str = $value;
        }
        else
        {
            $uuid_str = BaseUuid::uuid4();
        }
        $this->value = (string)$uuid_str;
    }
    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->value;
    }
    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->value;
    }
    /**
     * @inheritdoc
     * @param ValueObject|Uuid $object
     */
    public function equals(ValueObject $object)
    {
        if ($object instanceof Uuid === false)
        {
            return false;
        }
        if ($object->getUuid() === $this->getUuid())
        {
            return true;
        }
        return false;
    }
    /**
     * @return string
     */
    public function toString()
    {
        return $this->value;
    }
}