<?php

namespace Application\Service;

use Application\Entity\Hashtag;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Doctrine\ORM\EntityManager;

class HashtagService
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
        $hashtag = new Hashtag();
        $this->doctrineObject->hydrate($data, $hashtag);

        $this->entityManager->getConnection()->beginTransaction();
        try {
            $this->entityManager->persist($hashtag);
            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();

            return $hashtag;
        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            return $e;
        }
    }

    public function update($id, $data)
    {
        $hashtag = $this->entityManager->getReference('Application\Entity\Hashtag', $id);
        $this->doctrineObject->hydrate($data, $hashtag);

        $this->entityManager->getConnection()->beginTransaction();
        try {
            $this->entityManager->persist($hashtag);
            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();

            return $hashtag;
        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            return $e;
        }
    }

    public function delete($id)
    {
        $hashtag = $this->entityManager->getReference('Application\Entity\Hashtag', $id);

        $this->entityManager->getConnection()->beginTransaction();
        try {
            $this->entityManager->remove($hashtag);
            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();

            return true;
        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            return $e;
        }
    }
}