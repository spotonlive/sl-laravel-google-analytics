<?php

return [
    /**
     * Default analytics provider
     */
    'provider' => 'analytics-1',

    'providers' => [
        'analytics-1' => [
            /*
             * Default site ID
             * (Switchable)
             */
            'siteId' => '',

            /*
             * Your client ID
             */
            'clientId' => '',

            /*
             * Service e-mail
             */
            'serviceEmail' => '',

            /*
             * Upload your google analytics p12-certificate
             */
            'certificate' => storage_path('analytics/certificate.p12'),
        ],
    ],
];
