<?php

namespace Application\Factory\Controller;

use Application\Controller\HashtagController;
use Application\Filter\HashtagFilter;
use Application\Form\HashtagForm;
use Application\Service\HashtagService;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class HashtagControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Zend\ServiceManager\ServiceManager $serviceManager */
        $serviceManager = $serviceLocator->getServiceLocator();

        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');

        $doctrineObject = new DoctrineObject($entityManager);

        /** @var \SlmQueue\Job\JobPluginManager $jobPluginManager */
        $jobPluginManager = $serviceManager->get('SlmQueue\Job\JobPluginManager');

        /** @var \SlmQueue\Queue\QueuePluginManager $queueManager */
        $queuePluginManager = $serviceManager->get('SlmQueue\Queue\QueuePluginManager');

        /** @var \SlmQueueDoctrine\Queue\DoctrineQueue $queue */
        $queue = $queuePluginManager->get('default');

        $hashtagRepository = $entityManager->getRepository('Application\Entity\Hashtag');

        $hashtagFormFilter = new HashtagFilter();
        $hashtagForm = new HashtagForm($entityManager);
        $hashtagForm->setInputFilter($hashtagFormFilter);

        $hashtagService = new HashtagService($doctrineObject, $entityManager);

        $hashtagController = new HashtagController($hashtagRepository, $hashtagForm, $hashtagService, $doctrineObject);
        $hashtagController->setQueue($queue);
        $hashtagController->setJobPluginManager($jobPluginManager);

        return $hashtagController;
    }

}