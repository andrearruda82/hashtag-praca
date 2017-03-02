<?php

namespace Application\Job;

use SlmQueueDoctrine\Queue\DoctrineQueue;
use SlmQueue\Job\JobPluginManager;
use SlmQueue\Job\AbstractJob;
use Application\Repository\HashtagRepository;

class SearchHastagInstagramJob extends AbstractJob
{
    /** @var  $hashtagRepository \Application\Repository\HashtagRepository */
    protected $hashtagRepository;

    /** @var \SlmQueueDoctrine\Queue\DoctrineQueue $queue */
    protected $queue;

    /** @var \SlmQueue\Job\JobPluginManager $jobPluginManager */
    protected $jobPluginManager;

    public function __construct(
        HashtagRepository $hashtagRepository,
        JobPluginManager $jobPluginManager,
        DoctrineQueue $queue
    )
    {
        $this->hashtagRepository = $hashtagRepository;
        $this->jobPluginManager = $jobPluginManager;
        $this->queue = $queue;
    }

    public function execute()
    {
        $payload = $this->getContent();

        $id = $payload['id'];
        $campaign_id = $payload['campaign_id'];

        /** @var \Application\Entity\Hashtag $hashtag */
        $hashtag = $this->hashtagRepository->findOneById($id);

        if($hashtag instanceof \Application\Entity\Hashtag)
        {
            var_dump([
                'job' => __CLASS__,
                'dateRun' => date('d/m/Y'),
                'campaing' => $hashtag->getCampaign()->getName(),
                'period' => [
                    'start' => $hashtag->getCampaign()->getPeriodStart()->format('d/m/Y'),
                    'final' => $hashtag->getCampaign()->getPeriodFinal()->format('d/m/Y')
                ],
            ]);

            $dateCurrent = new \DateTime('now');

            if($dateCurrent > $hashtag->getCampaign()->getPeriodStart() && $dateCurrent < $hashtag->getCampaign()->getPeriodFinal())
            {
                $media = json_decode(file_get_contents('https://www.instagram.com/explore/tags/' . $hashtag->getTag() . '/?__a=1'), true);

                var_dump([
                    'tag' => $hashtag->getTag(),
                    'media' => [
                        'total' => count($media['tag']['media']['nodes']),
                        'nodes' => $media['tag']['media']['nodes']
                    ]
                ]);
            }

            $searchHashtagInstagramJob = $this->jobPluginManager->get('Application\Job\SearchHastagInstagramJob');
            $searchHashtagInstagramJob->setContent([
                'id' => $hashtag->getId(),
                'campaign_id' => $hashtag->getCampaign()->getId(),
            ]);
            $this->queue->push($searchHashtagInstagramJob,[
                'delay' => $hashtag->getRunTimeScript() . ' minutes'
            ]);
        }
    }

}