<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\Model\PresenceInterface;
use App\Traits\Model\Persistable;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Class Discount
 *
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\DiscountRepository")
 * @ORM\Table(name="abq_discount")
 */
class Discount implements PresenceInterface
{
    use Persistable, TimestampableEntity;

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;
    /**
     * @var User|null
     */
    private ?User $user;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $code;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private bool $used;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Discount
     */
    public function setId(int $id): Discount
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     *
     * @return Discount
     */
    public function setUser(?User $user): Discount
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return Discount
     */
    public function setCode(string $code): Discount
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return bool
     */
    public function isUsed(): bool
    {
        return $this->used;
    }

    /**
     * @param bool $used
     *
     * @return Discount
     */
    public function setUsed(bool $used): Discount
    {
        $this->used = $used;

        return $this;
    }
}
