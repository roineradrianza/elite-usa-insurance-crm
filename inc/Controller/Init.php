<?php

namespace RA_ELITE_USA\Controller;

use \RA_ELITE_USA\Controller\Nonces;
use \RA_ELITE_USA\Controller\Roles;

use \RA_ELITE_USA\Controller\Classes\ActionsHistory as ActionsHistoryClass;
use \RA_ELITE_USA\Controller\Classes\Admin as AdminClass;
use \RA_ELITE_USA\Controller\Classes\Inbox as InboxClass;
use \RA_ELITE_USA\Controller\Classes\Mail as MailClass;
use \RA_ELITE_USA\Controller\Classes\Options as OptionsClass;
use \RA_ELITE_USA\Controller\Classes\Quotes as QuotesClass;
use \RA_ELITE_USA\Controller\Classes\Template as TemplateClass;
use \RA_ELITE_USA\Controller\Classes\User as UserClass;
use \RA_ELITE_USA\Controller\Classes\Quotes\AgentAttachment as AgentAttachmentClass;
use \RA_ELITE_USA\Controller\Classes\Quotes\DocumentRequest as DocumentRequestClass;
use \RA_ELITE_USA\Controller\Classes\Quotes\InformationRequest as InformationRequestClass;
use RA_ELITE_USA\Controller\Classes\Quotes\ManagerAttachment as ManagerAttachmentClass;
use RA_ELITE_USA\Controller\Classes\Quotes\Modifications as ModificationsClass;

class Init 
{
    public function __construct()
    {
        new Nonces();
        new Roles();

        new ActionsHistoryClass();
        new AdminClass();
        new InboxClass();
        new MailClass();
        new OptionsClass();
        new QuotesClass();
        new TemplateClass();
        new UserClass();

        new AgentAttachmentClass();
        new DocumentRequestClass();
        new InformationRequestClass();
        new ManagerAttachmentClass();
        new ModificationsClass();
        
    }
}