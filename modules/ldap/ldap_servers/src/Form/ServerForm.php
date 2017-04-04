<?php

namespace Drupal\ldap_servers\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\ldap_servers\Entity\Server;

/**
 * Class ServerForm.
 *
 * @package Drupal\ldap_servers\Form
 */
class ServerForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    /** @var \Drupal\ldap_servers\Entity\Server $server */
    $server = $this->entity;

    $form['server'] = [
      '#type' => 'details',
      '#title' => t('Server'),
      '#open' => TRUE,
    ];

    $form['server']['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#maxlength' => 255,
      '#default_value' => $server->label(),
      '#description' => $this->t("Choose a unique <strong><em>name</em></strong> for this server configuration."),
      '#required' => TRUE,
    ];

    $form['server']['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $server->id(),
      '#machine_name' => [
        'exists' => '\Drupal\ldap_servers\Entity\Server::load',
      ],
      '#disabled' => !$server->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */
    $form['server']['status'] = [
      '#title' => $this->t('Enabled'),
      '#type' => 'checkbox',
      '#default_value' => $server->get('status'),
      '#description' => $this->t('Disable in order to keep configuration without having it active.'),
    ];

    $form['server']['type'] = [
      '#title' => $this->t('LDAP Server type'),
      '#type' => 'select',
      '#options' => [
        'default' => 'Default LDAP',
        'ad' => 'Active Directory',
        'novell_edir' => 'Novell',
        'openldap' => 'Open LDAP',
        'opendir' => 'Apple Open Directory',
      ],
      '#default_value' => $server->get('type'),
      '#description' => $this->t('This field is informative. It\'s purpose is to assist with default values and give validation warnings.'),
    ];

    $form['server']['address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Server address'),
      '#maxlength' => 255,
      '#default_value' => $server->get('address'),
      '#description' => $this->t("The domain name or IP address of your LDAP Server such as \"ad.unm.edu\".<br>For SSL use the form ldaps://DOMAIN such as \"ldaps://ad.unm.edu\""),
      '#required' => TRUE,
    ];

    $form['server']['port'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Server port'),
      '#maxlength' => 11,
      '#default_value' => $server->get('port') ? $server->get('port') : 389,
      '#description' => $this->t("The TCP/IP port on the above server which accepts LDAP connections. Must be an integer."),
      '#required' => TRUE,
    ];

    $form['server']['tls'] = [
      '#title' => $this->t('Use Start-TLS'),
      '#type' => 'checkbox',
      '#default_value' => $server->get('tls'),
      '#description' => $this->t("Secure the connection between the Drupal and the LDAP servers using TLS.<br><em>Note: To use START-TLS, you must set the LDAP Port to 389.</em>"),
    ];

    $form['bind'] = [
      '#type' => 'details',
      '#title' => t('Binding'),
    ];

    $form['bind']['bind_method'] = [
      '#default_value' => $server->get('bind_method') ? $server->get('bind_method') : 'service_account',
      '#type' => 'radios',
      '#title' => t('Binding Method for Searches'),
      '#options' => [
        'service_account' => t('Service Account Bind: Use credentials in the
        Service Account field below to bind to LDAP <br>
        <div class="description">This option is usually a best practice.<br>
        This is also required for provisioning LDAP accounts and groups.<br>
        For security reasons, this pair should belong to an  LDAP account with stripped down permissions.</div>'),

        'user' => t('Bind with Users Credentials: Use user\'s entered credentials
        to bind to LDAP<br><div class="description">This is only useful for modules that execute during user logon such
        as LDAP Authentication and LDAP Authorization.  <br> This option is not a best practice in most cases.
        <br> The user\'s dn must be of the form "cn=[username],[base dn]" for this option to work.</div>'),

        'anon_user' => t('Anonymous Bind for search, then Bind with Users Credentials<br>
        <div class="description">Searches for user dn then uses user\'s entered credentials to bind to LDAP.<br/> This is only useful for
        modules that work during user logon such as LDAP Authentication and LDAP Authorization. <br>
        The user\'s dn must be discovered by an anonymous search for this option to work.</div>'),

        'anon' => t('Anonymous Bind: Use no credentials to bind to LDAP server<br/>
        <div class="description">This option will not work on most LDAPS connections.</div>'),
      ],
    ];

    $form['bind']['binddn'] = [
      '#default_value' => $server->get('binddn'),
      '#type' => 'textfield',
      '#title' => t('DN for non-anonymous search'),
      '#size' => 80,
      '#maxlength' => 512,
      '#states' => [
        'visible' => [
          ':input[name=bind_method]' => ['value' => strval('service_account')],
        ],
        'required' => [
          ':input[name=bind_method]' => ['value' => strval('service_account')],
        ],
      ],
    ];

    $form['bind']['bindpw'] = [
      '#type' => 'password',
      '#title' => t('Password for non-anonymous search'),
      '#placeholder' => $server->get('bindpw') ? t("Password exists in database.") : t("Warning: No password exists in database."),
      '#size' => 80,
      '#states' => [
        'visible' => [
          ':input[name=bind_method]' => ['value' => strval('service_account')],
        ],
        'required' => [
          ':input[name=bind_method]' => ['value' => strval('service_account')],
        ],
      ],
    ];

    $form['users'] = [
      '#type' => 'details',
      '#title' => t('Users'),
    ];

    $form['users']['basedn'] = [
      '#default_value' => $server->get('basedn'),
      '#type' => 'textarea',
      '#cols' => 50,
      '#rows' => 6,
      '#title' => t('Base DNs for LDAP users, groups, and other entries.'),
      '#description' => '<div>' . t('DNs that have  relevant entries, e.g. <code>ou=campus accounts,dc=ad,dc=uiuc,dc=edu</code>.<br>
        Keep in mind that every additional basedn likely doubles the number of queries. <br> Place the
        more heavily used one first and consider using one higher base DN rather than 2 or more lower base DNs.<br>
        Enter one per line in case if you need more than one.') . '</div>',
    ];

    $form['users']['user_attr'] = [
      '#default_value' => $server->get('user_attr'),
      '#type' => 'textfield',
      '#size' => 30,
      '#title' => t('AuthName attribute'),
      '#description' => t('The attribute that holds the users\' login name. (eg. <code>cn</code> for eDir or <code>sAMAccountName</code> for Active Directory).'),
    ];

    $form['users']['account_name_attr'] = [
      '#default_value' => $server->get('account_name_attr'),
      '#type' => 'textfield',
      '#size' => 30,
      '#title' => t('AccountName attribute'),
      '#description' => t('The attribute that holds the unique account name. Defaults to the same as the AuthName attribute.'),
    ];

    $form['users']['mail_attr'] = [
      '#default_value' => $server->get('mail_attr'),
      '#type' => 'textfield',
      '#size' => 30,
      '#title' => t('Email attribute'),
      '#description' => t('The attribute that holds the users\' email address. (eg. <code>mail</code>). Leave empty if no such attribute exists'),
    ];

    $form['users']['mail_template'] = [
      '#default_value' => $server->get('mail_template'),
      '#type' => 'textfield',
      '#size' => 30,
      '#title' => t('Email template'),
      '#description' => t('If no attribute contains the user\'s email address, but it can be derived from other attributes,
        enter an email "template" here.<br>
        Templates should have the user\'s attribute name in form such as [cn], [uin], etc. such as <code>[cn]@mycompany.com</code>.<br>
        See also the <a href="http://drupal.org/node/997082">drupal.org documentation on LDAP tokens</a>.'),
    ];

    $form['users']['picture_attr'] = [
      '#default_value' => $server->get('picture_attr'),
      '#type' => 'textfield',
      '#size' => 30,
      '#title' => t('Thumbnail attribute'),
      '#description' => t('The attribute that holds the users\' thumnail image. (eg. <code>thumbnailPhoto</code>). Leave empty if no such attribute exists'),
    ];

    $form['users']['unique_persistent_attr'] = [
      '#default_value' => $server->get('unique_persistent_attr'),
      '#type' => 'textfield',
      '#size' => 30,
      '#title' => t('Persistent and Unique User ID Attribute'),
      '#description' => t('In some LDAPs, a user\'s DN, CN, or mail value may
        change when a user\'s name changes or for other reasons.<br>
        In order to avoid creation of multiple accounts for that user or other ambiguities,
        enter a unique and persistent ldap attribute for users. <br> In cases
        where DN does not change, enter "dn" here.
        If no such attribute exists, leave this blank.'
      ),
    ];

    $form['users']['unique_persistent_attr_binary'] = [
      '#default_value' => $server->get('unique_persistent_attr_binary'),
      '#type' => 'checkbox',
      '#title' => t('Does the <em>Persistent and Unique User ID Attribute</em>
         hold a binary value?'),
      '#description' => t('You need to set this if you are using a binary
        attribute  such as objectSid in ActiveDirectory for the PUID.<br> If you
        don\'t want this consider switching to another attribute, such as
        samaccountname.'),
    ];

    $form['users']['user_dn_expression'] = [
      '#default_value' => $server->get('user_dn_expression'),
      '#type' => 'textfield',
      '#size' => 80,
      '#title' => t('Expression for user DN. Required when "Bind with Users Credentials" method selected.'),
      '#description' => t('%username and %basedn are valid tokens in the expression.<br>
        Typically it will be: <code>cn=%username,%basedn</code> which might evaluate to <code>cn=jdoe,ou=campus accounts,dc=ad,dc=mycampus,dc=edu</code>'),
    ];

    $form['users']['testing_drupal_username'] = [
      '#default_value' => $server->get('testing_drupal_username'),
      '#type' => 'textfield',
      '#size' => 30,
      '#title' => t('Testing Drupal Username'),
      '#description' => t('This is optional and used for testing this server\'s configuration against an actual username') . '<br>' . t('The user need not exist in Drupal and testing will not affect the user\'s LDAP or Drupal Account.'),
    ];

    $form['users']['testing_drupal_user_dn'] = [
      '#default_value' => $server->get('testing_drupal_user_dn'),
      '#type' => 'textfield',
      '#size' => 120,
      '#title' => t('DN of testing username'),
      '#description' => t('This is optional and used for testing this server\'s configuration against an actual username, e.g. cn=hpotter,ou=people,dc=hogwarts,dc=edu.') . '<br>' . t('The user need not exist in Drupal and testing will not affect the user\'s LDAP or Drupal Account.'),
    ];

    $form['groups'] = [
      '#type' => 'details',
      '#title' => t('Groups'),
    ];

    $form['groups']['grp_unused'] = [
      '#default_value' => $server->get('grp_unused'),
      '#type' => 'checkbox',
      '#title' => t('Groups are not relevant to this Drupal site.  This is generally true if LDAP Groups and LDAP Authorization are not in use.'),
      '#disabled' => FALSE,
    ];

    $form['groups']['grp_nested'] = [
      '#default_value' => $server->get('grp_nested'),
      '#type' => 'checkbox',
      '#title' => t('Nested groups are used in my LDAP'),
      '#disabled' => FALSE,
      '#description' => t('If a user is a member of group A and group A is a member of group B,
         user should be considered to be in group A and B. <br> If your LDAP has nested groups, but you
         want to ignore nesting, leave this unchecked.'),
      '#states' => [
        'visible' => [
          ':input[name=grp_unused]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['groups']['grp_memb_attr'] = [
      '#default_value' => $server->get('grp_memb_attr'),
      '#type' => 'textfield',
      '#size' => 30,
      '#title' => t('LDAP Group Entry Attribute Holding User\'s DN, CN, etc.'),
      '#description' => t('e.g uniquemember, memberUid'),
      '#states' => [
        'visible' => [
          ':input[name=grp_unused]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['groups']['derive_group'] = [
      '#type' => 'fieldset',
      '#title' => t('Derive from group'),
      '#states' => [
        'visible' => [
          ':input[name=grp_unused]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['groups']['derive_group']['grp_object_cat'] = [
      '#default_value' => $server->get('grp_object_cat'),
      '#type' => 'textfield',
      '#size' => 30,
      '#title' => t('Name of Group Object Class'),
      '#description' => t('e.g. groupOfNames, groupOfUniqueNames, group.'),
      '#states' => [
        'visible' => [
          ':input[name=grp_unused]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['groups']['derive_group']['grp_memb_attr_match_user_attr'] = [
      '#default_value' => $server->get('grp_memb_attr_match_user_attr'),
      '#type' => 'textfield',
      '#size' => 30,
      '#title' => t('User attribute held in "LDAP Group Entry Attribute Holding..."'),
      '#description' => t('This is almost always "dn" (which technically isn\'t an attribute).  Sometimes its "cn".'),
      '#states' => [
        'visible' => [
          ':input[name=grp_unused]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['groups']['attribute'] = [
      '#type' => 'fieldset',
      '#title' => t('Derive from user attribute'),
      '#states' => [
        'visible' => [
          ':input[name=grp_unused]' => ['checked' => FALSE],
        ],
      ],
    ];
    $form['groups']['attribute']['grp_user_memb_attr_exists'] = [
      '#default_value' => $server->get('grp_user_memb_attr_exists'),
      '#type' => 'checkbox',
      '#title' => t('A user LDAP attribute such as <code>memberOf</code> exists that contains a list of their groups.'),
      '#description' => t('Active Directory and openLdap with memberOf overlay fit this model.') . '<br>' . t('Using this ignores "derive from group"'),
      '#disabled' => FALSE,
      '#states' => [
        'visible' => [
          ':input[name=grp_unused]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['groups']['attribute']['grp_user_memb_attr'] = [
      '#default_value' => $server->get('grp_user_memb_attr'),
      '#type' => 'textfield',
      '#size' => 30,
      '#title' => t('Attribute in User Entry Containing Groups'),
      '#description' => t('e.g. memberOf <em>(case sensitive)</em>.'),
      '#states' => [
        'enabled' => [
          ':input[name=grp_user_memb_attr_exists]' => ['checked' => TRUE],
        ],
        'visible' => [
          ':input[name=grp_unused]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['groups']['deriveDN'] = [
      '#type' => 'fieldset',
      '#title' => t('Derive from DN'),
      '#states' => [
        'visible' => [
          ':input[name=grp_unused]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['groups']['deriveDN']['grp_derive_from_dn'] = [
      '#default_value' => $server->get('grp_derive_from_dn'),
      '#type' => 'checkbox',
      '#title' => t('Groups are derived from user\'s LDAP entry DN.'),
      '#description' => t('This group definition has very limited functionality and most modules will not take this into account.  LDAP Authorization will.'),
      '#disabled' => FALSE,
      '#states' => [
        'visible' => [
          ':input[name=grp_unused]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['groups']['deriveDN']['grp_derive_from_dn_attr'] = [
      '#default_value' => $server->get('grp_derive_from_dn_attr'),
      '#type' => 'textfield',
      '#size' => 30,
      '#title' => t('Attribute of the User\'s LDAP Entry DN which contains the group'),
      '#description' => t('e.g. ou'),
      '#states' => [
        'enabled' => [
          ':input[name=grp_derive_from_dn]' => ['checked' => TRUE],
        ],
        'visible' => [
          ':input[name=grp_unused]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['groups']['grp_test_grp_dn'] = [
      '#default_value' => $server->get('grp_test_grp_dn'),
      '#type' => 'textfield',
      '#size' => 120,
      '#title' => t('Testing LDAP Group DN'),
      '#description' => t('This is optional and can be useful for debugging and validating forms.'),
      '#states' => [
        'visible' => [
          ':input[name=grp_unused]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['groups']['grp_test_grp_dn_writeable'] = [
      '#default_value' => $server->get('grp_test_grp_dn_writeable'),
      '#type' => 'textfield',
      '#size' => 120,
      '#title' => t('Testing LDAP Group DN that is writable.'),
      '#description' => t(' <strong>WARNING:</strong> the test script for the server will create, delete, and add members to this group!') . '<br>' . t('This is optional and can be useful for debugging and validating forms.'),
      '#placeholder' => t('Careful!'),
      '#states' => [
        'visible' => [
          ':input[name=grp_unused]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['pagination'] = [
      '#type' => 'details',
      '#title' => t('Pagination'),
    ];

    $form['pagination']['search_pagination'] = [
      '#default_value' => $server->get('search_pagination'),
      '#type' => 'checkbox',
      '#title' => t('Use LDAP Pagination.'),
    ];

    $form['pagination']['search_page_size'] = [
      '#default_value' => $server->get('search_page_size'),
      '#type' => 'textfield',
      '#size' => 10,
      '#title' => t('Pagination size limit.'),
      '#description' => t('This should be equal to or smaller than the max
        number of entries returned at a time by your ldap server.
        1000 is a good guess when unsure. Other modules such as LDAP Query
        or LDAP Feeds will be allowed to set a smaller page size, but not
        a larger one.'),
      '#states' => [
        'visible' => [
          ':input[name="search_pagination"]' => ['checked' => TRUE],
        ],
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    /** @var \Drupal\ldap_servers\Entity\Server $new_configuration */
    $new_configuration = $this->entity;

    // Handle the password as the form is empty.
    if (NULL !== $form_state->getValue('bindpw') && $form_state->getValue('bindpw')) {
      $new_configuration->set('bindpw', $form_state->getValue('bindpw'));
    }
    // If there isn't a password then load the existing one (unless this an anonymous bind server)
    elseif ($form_state->getValue('bind_method') != 'anon' || $form_state->getValue('bind_method') != 'anon_user') {
      $factory = \Drupal::service('ldap.servers');
      /** @var \Drupal\ldap_servers\Entity\Server $existing_configuration */
      $existing_configuration = $factory->getServerById($new_configuration->id());
      if ($existing_configuration && $existing_configuration->get('bindpw')) {
        $new_configuration->set('bindpw', $existing_configuration->get('bindpw'));
      }
    }

    if ($form_state->getValue('bind_method') != 'service_account') {
      $new_configuration->set('binddn', NULL);
      $new_configuration->set('bindpw', NULL);
    }

    $status = $new_configuration->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Server.', [
          '%label' => $new_configuration->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Server.', [
          '%label' => $new_configuration->label(),
        ]));
    }
    $form_state->setRedirectUrl($new_configuration->urlInfo('collection'));
  }

}
