<?php
return [
    'slm_queue' => [
        'job_manager' => [
            'factories' => [
                Application\Job\SearchHastagInstagramJob::class => Application\Factory\Job\SearchHastagInstagramJobFactory::class
            ],
            'invokables' => [
            ],
        ],
        'queue_manager' => [
            'factories' => [
                'default' => SlmQueueDoctrine\Factory\DoctrineQueueFactory::class
            ],
        ]
    ],
];