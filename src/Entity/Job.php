<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Job
 * Class Job
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 * @ORM\Table(name="job")
 *
 */
class Job
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    public $status;

    /**
     * @var string
     *
     * @ORM\Column(name="command", type="string", length=255)
     */
    public $command;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    public $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="start_at", type="datetime")
     */
    public $startAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="end_at", type="datetime")
     */
    public $endAt;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="processor", referencedColumnName="id")
     * })
     */
    public $processor;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="submitter", referencedColumnName="id")
     * })
     */
    public $submitter;

    /**
     * Job constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->status = 'PENDING';
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCommand(): ?string
    {
        return $this->command;
    }

    /**
     * @param string $command
     * @return $this
     */
    public function setCommand(string $command): self
    {
        $this->command = $command;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface|null $createdAt
     * @return $this
     */
    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    /**
     * @param \DateTimeInterface|null $startAt
     * @return $this
     */
    public function setStartAt(?\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    /**
     * @param \DateTimeInterface|null $endAt
     * @return $this
     */
    public function setEndAt(?\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getProcessor(): ?User
    {
        return $this->processor;
    }

    /**
     * @param User|null $processor
     * @return $this
     */
    public function setProcessor(?User $processor): self
    {
        $this->processor = $processor;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getSubmitter(): ?User
    {
        return $this->submitter;
    }

    /**
     * @param User|null $submitter
     * @return $this
     */
    public function setSubmitter(?User $submitter): self
    {
        $this->submitter = $submitter;

        return $this;
    }
}
