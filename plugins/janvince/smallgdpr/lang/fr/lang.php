<?php

return [

  'plugin' => [
    'name' => 'Small GDPR',
    'description' => 'Outils GDPR',
    'category' => 'Small plugins',
  ],

  'persmissions' => [
    'access_settings' => "Peut modifier les paramètres",
  ],

  'settings' => [

    'cookies' => [
      'name' => 'Cookies',
      'description' => 'Gestion du popup GDPR',
    ],

    'tabs' => [
      'cookies_list' => 'Groupes de cookies',
      'cookies_bar' => 'Popup des cookies',
      'cookies_manage' => 'Popup détaillé',
      'settings' => 'Paramètres',
      'import' => 'Importer',
      'export' => 'Exporter',
    ],

    'form_fields' => [
      'title' => 'Titre',
      'content' => 'Contenu',
      'slug' => 'Code',
      'url' => 'URL',
      'url_external' => 'URL externe',
      'url_external_description' => "L'url envoie sur une adresse externe (eg. https://www.google.com).",
      'description' => 'Description',
      'purpose' => 'Purpose',
      'purpose_description' => '',
      'cookies_list' => 'Groupes de cookies',
      'cookies_list_description' => 'Eg. Requis, Statistiques, ...',
      'cookies_list_prompt' => 'Ajouter un groupe',
      'cookie_required' => 'Requis',
      'cookie_required_description' => "Ces cookies ne peuvent être désactivés par l'utilisateur",
      'cookie_default_enabled' => 'Activé par défaut',
      'cookie_default_enabled_description' => 'This cookies will be executed even without explicit concent (should be used only for anonymous data!).',
      'cookies_manager' => 'Gérer les cookies',
      'cookies_bar_buttons' => 'Boutons',
      'cookies_bar_buttons_prompt' => 'Ajouter un bouton',
      'cookies_bar_content' => 'Contenu',
      'css_class' => 'Class CSS',
      'add_css' => 'Utiliser le style par défaut',
      'add_css_description' => 'Automatically inserts default bar styles',
      'accept_all_cookies_btn' => 'Accepter tout les cookies',
      'accept_all_cookies_btn_description' => 'By clicking on this button, all cookies will be accepted automatically and the bar will disappear.',
      'import' => 'Importer les paramètres',
      'import_confirm' => 'Are you sure you want to import settings? Old settings will be lost!',
      'import_path_description' => 'Select your settings file or leave empty for a default preset file: ',
      'import_path_media' => 'Select import file from Media',
      'import_path_media_description' => 'This file has presedence over the manually entered path below.',
      'export' => 'Export settings',
      'cookies_lifetime_days' => 'Expiration des Cookies (en jours)',
      'cookies_lifetime_days_comment' => 'La durée de vie des cookies dans le navigateur',
      'save_settings' => 'Enregistrer',
      'scripts' => 'Scripts',
      'scripts_title' => 'Titre (facultatif)',
      'scripts_title_description' => 'Utilisé uniquement pour la description',
      'scripts_prompt' => 'Ajouter un script',
      'scripts_code' => 'Code JS personnalisé',
      'scripts_code_description' => 'This code will be included if group is required or allowed by user. Please use "<script></script>" tags for JS code.',
      'scripts_file' => 'Run JS file',
      'scripts_file_description' => "Execute this file.",
      'scripts_run_production' => 'Run only in production',
      'scripts_run_production_description' => "Execute JS code and file only in production environment.",
      'attributes' => 'HTML tag attributes',
      'show_modal' => 'Open modal window',
      'show_modal_description' => 'Open modal window with cookies settings by clicking on this button (for now works only when Bootstrap style is enabled on Settings tab).',
      'empty_option' => 'Select an option',
      'cancel' => 'Annuler',
      'ui_style' => 'UI style',
      'ui_style_description' => 'Components can format HTML for specific framework',
      'ui_style_option_empty' => 'HTML simple',
    ],
  ],

  'components' => [

    'cookies_bar' => [
      'name' => 'Cookies bar',
      'description' => 'Bar with information about used cookies',
    ],

    'cookies_manage' => [
      'name' => 'Manage cookies',
      'description' => 'Component for user management of cookies',
    ],
  ],

  'formwidgets' => [

    'importpreset' => [

      'file_name' => 'Or you can enter your import file path manually',
      'file_name_comment' => 'Will be used only when there is no file selected from Media! Keep empty for default plugin preset file.',
      'file_name_default' => '/plugins/janvince/smallgdpr/assets/presets/cookiesbar.en.yaml',
      'import_confirm' => 'Do you really want to import your data?',

      'flash' => [
        'import_successfull' => 'Data was imported successfully',
        'import_error' => 'Failed to import data. More information in the system log.',
        'parse_error' => 'Failed to process data from file. More information in the system log.',
        'file_error' => 'Could not find file! Check the name and path.',
        'file_missing_error' => 'No file was selected!',
      ],
    ],

    'exportpreset' => [

      'file_name' => 'Path to the file',
      'file_name_comment' => 'Complete path to the exported file.',
      'file_name_default' => '/storage/app/media/small-gdpr-export.yaml',

      'flash' => [
        'export_successfull' => 'Data was imported successfully',
        'export_error' => 'There was an error while exporting. More info in system log.',
        'parse_error' => 'Failed to process settings data. More information in the system log.',
        'file_error' => 'Could not write to file! Check the name and path.',
      ],
    ],
  ],
];
