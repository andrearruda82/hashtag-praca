<?php

namespace Application\Controller;

use Application\Form\CampaignForm;
use Application\Repository\CampaignRepository;
use Application\Service\CampaignService;
use Zend\Hydrator\ClassMethods;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\View\Model\ViewModel;

class CampaignController extends AbstractActionController
{
    protected $campaignRepository;
    protected $campaignForm;
    protected $campaignService;
    protected $doctrineObject;

    public function __construct(
        CampaignRepository $campaignRepository,
        CampaignForm $campaignForm,
        CampaignService $campaignService
    )
    {
        $this->campaignRepository = $campaignRepository;
        $this->campaignForm = $campaignForm;
        $this->campaignService = $campaignService;
    }

    public function indexAction()
    {
        $data = $this->campaignRepository->findAll();

        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($data));
        $paginator->setCurrentPageNumber($page);

        return new ViewModel([
            'data' => $paginator,
            'page' => $page
        ]);
    }

    public function addAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = array_merge(
                $this->getRequest()->getPost()->toArray()
            );

            $this->campaignForm->setData($data);

            if ($this->campaignForm->isValid())
            {
                $result = $this->campaignService->create($data);

                if ($result instanceof \Application\Entity\Campaign) {
                    $this->flashMessenger()->addMessage([
                        'type' => 'success',
                        'title' => 'Yeah!',
                        'message' => 'Ação realizada c/ sucesso!'
                    ]);

                    return $this->redirect()->toRoute('campaign');
                }

                $this->flashMessenger()->addMessage([
                    'type' => 'error',
                    'title' => 'Ops!',
                    'message' => 'Falha ao realizar ação.'
                ]);

                return $this->redirect()->toRoute('campaign');
            }
        }

        $viewModel = new ViewModel([
            'form' => $this->campaignForm
        ]);
        $viewModel->setTemplate('application/campaign/form.phtml');

        return $viewModel;
    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('id');

        $campaign = $this->campaignRepository->findOneById($id);
        $data = (new ClassMethods())->extract($campaign);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = array_merge(
                $this->getRequest()->getPost()->toArray()
            );
        }


        $viewModel = new ViewModel([
            'form' => $this->campaignForm->setData($data)
        ]);
        $viewModel->setTemplate('application/campaign/form.phtml');

        return $viewModel;
    }
}