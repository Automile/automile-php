<?php

namespace Automile\Sdk\Models\PublishSubscribeAuthentication;

use Automile\Sdk\Types\PublishSubscribeAuthenticationType;

/**
 * PublishSubscribeAuthenticationSalesforce Model
 */
class Salesforce extends AuthenticationAbstract
{

    protected $_allowedProperties = [
        'OrganisationId',
        'InstanceUrl',
        'ClientSecret',
        'ClientId',
        'AuthCode',
        'RedirectUrl'
    ];

    /**
     * @see PublishSubscribeAuthenticationType
     * @return int
     */
    public function getAuthenticationType()
    {
        return PublishSubscribeAuthenticationType::SALESFORCE;
    }
}
