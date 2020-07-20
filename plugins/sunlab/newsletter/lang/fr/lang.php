<?php return [
    'plugin' => [
        'name' => 'Newsletter',
        'description' => "Permet de s'abonner à la newsletter d'un blog",
    ],
    'subscriber' => [
        'email' => 'Email',
        'categories' => 'Catégories',
    ],
    'menu' => [
        'subscribers' => 'Inscrits',
        'import' => 'Importer',
        'export' => 'Exporter',
    ],
    'permission' => [
        'manage_newsletter' => 'Gérer la newsletter',
    ],
    'component' => [
        'name'                  => "Formulaire d'inscription",
        'description'           => "Affiche le formulaire d'inscription à la newsletter",
        'csrf_error'            => 'Form session expired! Please refresh the page.',
        'empty_error'           => 'Please do not leave free space.',
        'in_success_text'       => 'Thanks created your subscription registration',
        'out_success_text'      => 'Your subscription has been canceled',
        'save_error'            => 'please try again later',
        'email_error'           => '%s is a valid email address',
        'validateEmail'         => 'Validate e-mail',
    ],
    'settings' => [
        // Menu
        'menu-label'        => 'Newsletter',
        'menu-description'  => 'Gestion des paramètre de la newsletter',

        // Sections
        'subscription_section'   => 'Souscription',
        'unsubscription_section' => 'Souscription',
        'newsletter_section'     => 'Souscription',
        'logs_section'           => 'Journaux',

        // Fields
        'subscription_from'                 => 'Adresse email "from"',
        'subscription_replyTo'              => 'Adresse email "reply-to"',
        'subscription_needConfirmation'     => 'Nécessite une confirmation par mail',
        'unsubscription_from'               => 'Adresse email "from"',
        'unsubscription_replyTo'            => 'Adresse email "reply-to"',
        'unsubscription_needConfirmation'   => 'Nécessite une confirmation par mail',
        'newsletter_from'                   => 'Adresse email "from"',
        'newsletter_replyTo'                => 'Adresse email "reply-to"',
        'newsletter_frequencies'                  => 'Délais possible entre chaque email',
        'newsletter_frequencies_comment'          => 'En jours, séparés par des virgules. Exemple: 1, 3, 7 pour 1 jour, 3 jours et 1 semaine',
        'logs_to'                           => 'Envoyer le résultat de chaque cron à cette adresse',
        'logs_activated'                    => 'Activation des journaux',
        'logs_storage_path'                 => 'Il sera stocké dans /storage/logs/sunlab/newsletter.txt',
    ]
];
