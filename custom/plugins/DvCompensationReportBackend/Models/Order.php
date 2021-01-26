<?php declare(strict_types=1);

namespace DvCompensationReportBackend\Models;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="s_order")
 * @ORM\HasLifecycleCallbacks()
 */
class Order extends ModelEntity
{
   /**
     * Unique identifier field.
     *
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="userID", type="integer", nullable=false)
     */
    private $customerId;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getCustomerId(){
        return $this->customerId;
    }

}
