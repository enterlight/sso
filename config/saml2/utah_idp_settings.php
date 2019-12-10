<?php

//$sp_host = 'http://3c5bee39.ngrok.io';

return $settings = array(

    /*****
     * One Login Settings
     */

    // If 'strict' is True, then the PHP Toolkit will reject unsigned
    // or unencrypted messages if it expects them signed or encrypted
    // Also will reject the messages if not strictly follow the SAML
    // standard: Destination, NameId, Conditions ... are validated too.
    'strict' => true, //@todo: make this depend on laravel config

    // Enable debug mode (to print errors)
    'debug' => env('APP_DEBUG', false),

    'baseurl' => null,

    // Service Provider Data that we are deploying
    'sp' => array(

        // Specifies constraints on the name identifier to be used to
        // represent the requested subject.
        // Take a look on lib/Saml2/Constants.php to see the NameIdFormat supported
        'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',

        // Usually x509cert and privateKey of the SP are provided by files placed at
        // the certs folder. But we can also provide them with the following parameters
        'x509cert' => '',
        'privateKey' => '',

        // Identifier (URI) of the SP entity.
        // Leave blank to use the '{idpName}_metadata' route, e.g. 'test_metadata'.
        // Also know as Audience
        'entityId' => '',

        // Specifies info about where and how the <AuthnResponse> message MUST be
        // returned to the requester, in this case our SP.
        // Also know as ACS URL
        'assertionConsumerService' => array(
            // URL Location where the <Response> from the IdP will be returned,
            // using HTTP-POST binding.
            // Leave blank to use the '{idpName}_acs' route, e.g. 'test_acs'
            'url' => '',
        ),
        // Specifies info about where and how the <Logout Response> message MUST be
        // returned to the requester, in this case our SP.
        // Remove this part to not include any URL Location in the metadata.
        // Also know as ACS Issuer
        'singleLogoutService' => array(
            // URL Location where the <Response> from the IdP will be returned,
            // using HTTP-Redirect binding.
            // Leave blank to use the '{idpName}_sls' route, e.g. 'test_sls'
            'url' => '',
        ),
    ),

    // Identity Provider Data that we want connect with our SP
    'idp' => array(
        // Identifier of the IdP entity  (must be a URI)

        'entityId' => 'https://saml.dev.utah.gov:443/sso',

        // SSO endpoint info of the IdP. (Authentication Request protocol)
        'singleSignOnService' => array(
            // URL Target of the IdP where the SP will send the Authentication Request Message,
            // using HTTP-Redirect binding.

            'url' => 'https://saml.dev.utah.gov:443/sso/SSORedirect/metaAlias/idp2',
        ),
        // SLO endpoint info of the IdP.
        'singleLogoutService' => array(
            // URL Location of the IdP where the SP will send the SLO Request,
            // using HTTP-Redirect binding.

            'url' => 'https://saml.dev.utah.gov:443/sso/IDPSloRedirect/metaAlias/idp2',
        ),
        // Public x509 certificate of the IdP

        'x509cert' => 'MIICzDCCAjWgAwIBAgIEbRAH8zANBgkqhkiG9w0BAQsFADCBmDELMAkGA1UEBhMCVVMxDTALBgNV BAgTBFV0YWgxFzAVBgNVBAcTDlNhbHQgTGFrZSBDaXR5MSowKAYDVQQKEyFEZXBhcnRtZW50IG9m IFRlY2hub2xvZ3kgU2VydmljZXMxHDAaBgNVBAsTE0hvc3RpbmcgRW5naW5lZXJpbmcxFzAVBgNV BAMTDkt5bGUgQnVya2hhcmR0MB4XDTE3MDcxMzIyMDEzOFoXDTIyMDcxMjIyMDEzOFowgZgxCzAJ BgNVBAYTAlVTMQ0wCwYDVQQIEwRVdGFoMRcwFQYDVQQHEw5TYWx0IExha2UgQ2l0eTEqMCgGA1UE ChMhRGVwYXJ0bWVudCBvZiBUZWNobm9sb2d5IFNlcnZpY2VzMRwwGgYDVQQLExNIb3N0aW5nIEVu Z2luZWVyaW5nMRcwFQYDVQQDEw5LeWxlIEJ1cmtoYXJkdDCBnzANBgkqhkiG9w0BAQEFAAOBjQAw gYkCgYEA1lexdVXvNBB6HkIgaLOLgPNGVfc+fY6c3F/tcLZKwn04CYYrnD/1JAcpxO4v5fWYKjCR ms6pJLl9H5F3FoNje3TdJ7rYtfPaUgF4XJKXnw3WjzER8fIc9NPp8c8vxAio1EaSL6wmlmZw5lGD ulQwo89ItrwWHB2QnK5c6lQpQLcCAwEAAaMhMB8wHQYDVR0OBBYEFGsia1nXza2ZGwQ8DAO2kV1x nI+tMA0GCSqGSIb3DQEBCwUAA4GBAKh2rAR/WuJjSqEkhH1JwP4CGaZymZWgptuK+/URO7w07tbD 1FWRlyhU70kJIRO6J2DUz2fi1KtM2hMcZVUijDl6lLnwXJJmCWh0N+5UeQWQuwuFmPisi9JxPl4F 7q3JMI7CNu/EU3GpxONC7OCj09wbkWUxQJIJ+1HmHsM07iO1',
        /*
         *  Instead of use the whole x509cert you can use a fingerprint
         *  (openssl x509 -noout -fingerprint -in "idp.crt" to generate it)
         */
        // 'certFingerprint' => '',
    ),



    /***
     *
     *  OneLogin advanced settings
     *
     *
     */
    // Security settings
    'security' => array(

        /** signatures and encryptions offered */

        // Indicates that the nameID of the <samlp:logoutRequest> sent by this SP
        // will be encrypted.
        'nameIdEncrypted' => false,

        // Indicates whether the <samlp:AuthnRequest> messages sent by this SP
        // will be signed.              [The Metadata of the SP will offer this info]
        'authnRequestsSigned' => false,

        // Indicates whether the <samlp:logoutRequest> messages sent by this SP
        // will be signed.
        'logoutRequestSigned' => false,

        // Indicates whether the <samlp:logoutResponse> messages sent by this SP
        // will be signed.
        'logoutResponseSigned' => false,

        /* Sign the Metadata
         False || True (use sp certs) || array (
                                                    keyFileName => 'metadata.key',
                                                    certFileName => 'metadata.crt'
                                                )
        */
        'signMetadata' => false,


        /** signatures and encryptions required **/

        // Indicates a requirement for the <samlp:Response>, <samlp:LogoutRequest> and
        // <samlp:LogoutResponse> elements received by this SP to be signed.
        'wantMessagesSigned' => false,

        // Indicates a requirement for the <saml:Assertion> elements received by
        // this SP to be signed.        [The Metadata of the SP will offer this info]
        'wantAssertionsSigned' => false,

        // Indicates a requirement for the NameID received by
        // this SP to be encrypted.
        'wantNameIdEncrypted' => false,

        // Authentication context.
        // Set to false and no AuthContext will be sent in the AuthNRequest,
        // Set true or don't present thi parameter and you will get an AuthContext 'exact' 'urn:oasis:names:tc:SAML:2.0:ac:classes:PasswordProtectedTransport'
        // Set an array with the possible auth context values: array ('urn:oasis:names:tc:SAML:2.0:ac:classes:Password', 'urn:oasis:names:tc:SAML:2.0:ac:classes:X509'),
        'requestedAuthnContext' => true,

        // If true, Destination URL should strictly match to the address to
        // which the response has been sent.
        // Notice that if 'relaxDestinationValidation' is true an empty Destintation
        // will be accepted.
        'destinationStrictlyMatches' => false,
    ),

    // Contact information template, it is recommended to suply a technical and support contacts
    'contactPerson' => array(
        'technical' => array(
            'givenName' => 'name',
            'emailAddress' => 'no@reply.com'
        ),
        'support' => array(
            'givenName' => 'Support',
            'emailAddress' => 'no@reply.com'
        ),
    ),

    // Organization information template, the info in en_US lang is recomended, add more if required
    'organization' => array(
        'en-US' => array(
            'name' => 'Name',
            'displayname' => 'Display Name',
            'url' => 'http://url'
        ),
    ),

/* Interoperable SAML 2.0 Web Browser SSO Profile [saml2int]   http://saml2int.org/profile/current

   'authnRequestsSigned' => false,    // SP SHOULD NOT sign the <samlp:AuthnRequest>,
                                      // MUST NOT assume that the IdP validates the sign
   'wantAssertionsSigned' => true,
   'wantAssertionsEncrypted' => true, // MUST be enabled if SSL/HTTPs is disabled
   'wantNameIdEncrypted' => false,
*/

);
