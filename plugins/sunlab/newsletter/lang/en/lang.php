<?php return [
    'plugin' => [
        'name' => 'Subscription',
        'description' => '',
    ],
    'subtype' => [
        'name' => 'Name',
    ],
    'subscriber' => [
        'data' => 'Data',
        'subtype' => 'Subscriber type',
        'accepst' => 'Active',
        'content_id' => 'Content ID',
        'content_id_desc' => 'Other contetn row id',
        'content_type' => 'Content type',
        'content_type_desc' => 'Data model name or your group name for content_id',
    ],
    'menu' => [
        'subscriber' => 'Subscriber',
        'import' => 'Import',
        'export' => 'Export',
    ],
    'permission' => [
        'subscriber' => 'subscriber manage',
    ],
    'component' => [
        'csrf_error'            => 'Form session expired! Please refresh the page.',
        'empty_error'           => 'Please do not leave free space.',
        'in_success_text'       => 'Thanks created your subscription registration',
        'out_success_text'      => 'Your subscription has been canceled',
        'save_error'            => 'please try again later',
        'email_error'           => '%s is a valid email address',
        'validateEmail'         => 'Validate e-mail',
    ],
];