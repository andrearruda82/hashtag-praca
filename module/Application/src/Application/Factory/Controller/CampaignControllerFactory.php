<?php

namespace Application\Factory\Controller;

use Application\Controller\CampaignController;
use Application\Filter\CampaignFilter;
use Application\Form\CampaignForm;
use Application\Service\CampaignService;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CampaignControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Zend\ServiceManager\ServiceManager $serviceManager */
        $serviceManager = $serviceLocator->getServiceLocator();

        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');

        $doctrineObject = new DoctrineObject($entityManager);

        $campaignRepository = $entityManager->getRepository('Application\Entity\Campaign');

        $campaignFormFilter = new CampaignFilter();
        $campaignForm = new CampaignForm();
        $campaignForm->setInputFilter($campaignFormFilter);

        $campaignService = new CampaignService($doctrineObject, $entityManager);

        return new CampaignController($campaignRepository, $campaignForm, $campaignService, $doctrineObject);
    }

}