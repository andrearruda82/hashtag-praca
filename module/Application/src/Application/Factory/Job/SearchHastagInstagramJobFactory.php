<?php

namespace Application\Factory\Job;

use Application\Job\SearchHastagInstagramJob;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SearchHastagInstagramJobFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Zend\ServiceManager\ServiceManager $serviceManager */
        $serviceManager = $serviceLocator->getServiceLocator();

        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');

        $hashtagRepository = $entityManager->getRepository('Application\Entity\Hashtag');

        /** @var \SlmQueue\Job\JobPluginManager $jobPluginManager */
        $jobPluginManager = $serviceManager->get('SlmQueue\Job\JobPluginManager');

        /** @var \SlmQueue\Queue\QueuePluginManager $queueManager */
        $queuePluginManager = $serviceManager->get('SlmQueue\Queue\QueuePluginManager');

        /** @var \SlmQueueDoctrine\Queue\DoctrineQueue $queue */
        $queue = $queuePluginManager->get('default');

        return new SearchHastagInstagramJob($hashtagRepository, $jobPluginManager, $queue);
    }

}