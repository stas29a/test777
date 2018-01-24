<?php
namespace App\Services\Downloader\Entities;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tasks")
 */
class Task implements \JsonSerializable
{
    const STATUS_PENDING = 1;
    const STATUS_DOWNLOADING = 2;
    const STATUS_COMPLETE = 3;
    const STATUS_ERROR = 4;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ODM\Id(type="integer", strategy="increment")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name='external_url')
     */
    protected $externalUrl;

    /**
     * @ORM\Column(type="string", name='local_url')
     */
    protected $localUrl;

    /**
     * @ORM\Column(type="datetime", name='created_at')
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", name='updated_at')
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @ORM\Column(type="integer")
     */
    protected $status;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getExternalUrl()
    {
        return $this->externalUrl;
    }

    /**
     * @param mixed $externalUrl
     */
    public function setExternalUrl($externalUrl)
    {
        $this->externalUrl = $externalUrl;
    }

    /**
     * @return mixed
     */
    public function getLocalUrl()
    {
        return $this->localUrl;
    }

    /**
     * @param mixed $localUrl
     */
    public function setLocalUrl($localUrl)
    {
        $this->localUrl = $localUrl;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'externalUrl' => $this->externalUrl,
            'localUrl' => $this->localUrl,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'status' => $this->status
        ];
    }


}