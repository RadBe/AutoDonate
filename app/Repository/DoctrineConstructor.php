<?php


namespace App\Repository;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

trait DoctrineConstructor
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var EntityRepository
     */
    private $er;

    /**
     * DoctrineConstructor constructor.
     * @param EntityManagerInterface $em
     * @param EntityRepository $er
     */
    public function __construct(EntityManagerInterface $em, EntityRepository $er)
    {
        $this->em = $em;
        $this->er = $er;
    }
}