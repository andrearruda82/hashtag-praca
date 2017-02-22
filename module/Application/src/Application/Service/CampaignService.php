<?php

namespace Application\Service;

use Application\Entity\Campaign;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Doctrine\ORM\EntityManager;

class CampaignService
{
    protected $doctrineObject;
    protected $entityManager;

    public function __construct(DoctrineObject $doctrineObject, EntityManager $entityManager)
    {
        $this->doctrineObject = $doctrineObject;
        $this->entityManager = $entityManager;
    }

    public function create($data)
    {
        if (isset($data['period_start']))
        {
            $data['period_start'] = \DateTime::createFromFormat('d/m/Y', $data['period_start']);
        }

        if (isset($data['period_final']))
        {
            $data['period_final'] = \DateTime::createFromFormat('d/m/Y', $data['period_final']);
        }

        $campaign = new Campaign();
        $this->doctrineObject->hydrate($data, $campaign);

        $this->entityManager->getConnection()->beginTransaction();
        try {
            $this->entityManager->persist($campaign);
            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();

            return $campaign;
        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            return $e;
        }
    }
}