<?php

// If you choose to use ENV vars to define these values, give this IdP its own env var names
// so you can define different values for each IdP, all starting with 'SAML2_'.$this_idp_env_id
$this_idp_env_id = 'TEST';

//This is variable is an example - Just make sure that the urls in the 'idp' config are ok.
$idp_host = 'https://idp.ssocircle.com:443';

$sp_host = 'http://3c5bee39.ngrok.io';

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



    // Service Provider Data that we are deploying
    'sp' => array(

        // Specifies constraints on the name identifier to be used to
        // represent the requested subject.
        // Take a look on lib/Saml2/Constants.php to see the NameIdFormat supported
        'NameIDFormat' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent',

        // Usually x509cert and privateKey of the SP are provided by files placed at
        // the certs folder. But we can also provide them with the following parameters
        'x509cert' => '',
        'privateKey' => '',

        // Identifier (URI) of the SP entity.
        // Leave blank to use the '{idpName}_metadata' route, e.g. 'test_metadata'.
        'entityId' => $sp_host . '/saml2/test/metadata',

        // Specifies info about where and how the <AuthnResponse> message MUST be
        // returned to the requester, in this case our SP.
        'assertionConsumerService' => array(
            // URL Location where the <Response> from the IdP will be returned,
            // using HTTP-POST binding.
            // Leave blank to use the '{idpName}_acs' route, e.g. 'test_acs'
            'url' => $sp_host . '/saml2/test/acs',
        ),
        // Specifies info about where and how the <Logout Response> message MUST be
        // returned to the requester, in this case our SP.
        // Remove this part to not include any URL Location in the metadata.
        'singleLogoutService' => array(
            // URL Location where the <Response> from the IdP will be returned,
            // using HTTP-Redirect binding.
            // Leave blank to use the '{idpName}_sls' route, e.g. 'test_sls'
            'url' => $sp_host . '/saml2/test/sls',
        ),
    ),

    // Identity Provider Data that we want connect with our SP
    'idp' => array(
        // Identifier of the IdP entity  (must be a URI)

        'entityId' => 'https://app.onelogin.com/saml/metadata/18fd89ef-4393-44b5-9c15-9f02e887628a',
        // SSO endpoint info of the IdP. (Authentication Request protocol)
        'singleSignOnService' => array(
            // URL Target of the IdP where the SP will send the Authentication Request Message,
            // using HTTP-Redirect binding.

            'url' => 'https://utah-sso-dev.onelogin.com/trust/saml2/http-post/sso/18fd89ef-4393-44b5-9c15-9f02e887628a',
        ),
        // SLO endpoint info of the IdP.
        'singleLogoutService' => array(
            // URL Location of the IdP where the SP will send the SLO Request,
            // using HTTP-Redirect binding.

            'url' => 'https://utah-sso-dev.onelogin.com/trust/saml2/http-redirect/slo/1033410',
        ),
        // Public x509 certificate of the IdP

        'x509cert' => '-----BEGIN CERTIFICATE-----
MIID2DCCAsCgAwIBAgIULRrKLyQqyERYaLD6+uvsrtP+21AwDQYJKoZIhvcNAQEF
BQAwRDEPMA0GA1UECgwGQWtlcm5hMRUwEwYDVQQLDAxPbmVMb2dpbiBJZFAxGjAY
BgNVBAMMEU9uZUxvZ2luIEFjY291bnQgMB4XDTE5MTEyNjIxMjUyMFoXDTI0MTEy
NjIxMjUyMFowRDEPMA0GA1UECgwGQWtlcm5hMRUwEwYDVQQLDAxPbmVMb2dpbiBJ
ZFAxGjAYBgNVBAMMEU9uZUxvZ2luIEFjY291bnQgMIIBIjANBgkqhkiG9w0BAQEF
AAOCAQ8AMIIBCgKCAQEAvKQ5CjHiM2Fnyywp86zP+d9LbotkIglwp5vsk1bPqhj4
lMICog339eqFjPILsiUxjFb7ZKidaMSYzLQEo+MTL65ZYeB4fbv6TRtg4uXf4ab1
CI6flwE8dKpWSYObpFhpG041Gd0+KXDDpBJraFx3pMIBXnccce/nTkq8mTkkFcU6
n+h3x9Q6zi9xKnC30afAAOo7DTmoRL6C2eZ4dbd2FmMOupGA0+ZFuEYJhpFvZt8b
XbB4+v6iNUm6ZzIgtt+x6cJ0eJbg/piJfYgwjnvx4zV9YKVW6PGWffeTTQboambp
l+JMzoVr0DCtF1mEjCwBfR04yaHe/N7hooK7btzLbwIDAQABo4HBMIG+MAwGA1Ud
EwEB/wQCMAAwHQYDVR0OBBYEFNm+V8iuhG5Q300oB49+us82RyRUMH8GA1UdIwR4
MHaAFNm+V8iuhG5Q300oB49+us82RyRUoUikRjBEMQ8wDQYDVQQKDAZBa2VybmEx
FTATBgNVBAsMDE9uZUxvZ2luIElkUDEaMBgGA1UEAwwRT25lTG9naW4gQWNjb3Vu
dCCCFC0ayi8kKshEWGiw+vrr7K7T/ttQMA4GA1UdDwEB/wQEAwIHgDANBgkqhkiG
9w0BAQUFAAOCAQEApxLnFReMv5x5TjX4zoUwK7UJ7dzMIPMcJY1un7OWVNBXNrvw
VNbrDnTj17yYac4XzDgi2hzlDFz9VxNVvGokA8qwGyoxmBBbsZ/UqLQX46NLGGmk
SgWkop4di0qOeiuPpHyo5TMALb29pRZQE4Lkcrcm++rFUdmW19RyMGduQGDelQTp
REwxL+9oi48C+eyg2nbZANGcidwrY0ssxhYXdb6Gcl8Kq6RuYhUvh8TzesG04P+G
V2XIo7jNVoxcpRZEFuExE7X4SWgU98Wk13VQ6B0cwQ7GH8v6qDDawX/tPrQW+Ehf
PtXG3X9J0VAZE/F5dzUGJYilvi4jRa4bgcV60g==
-----END CERTIFICATE-----'
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
