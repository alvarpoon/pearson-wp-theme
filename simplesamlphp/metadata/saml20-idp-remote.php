<?php
/**
 * SAML 2.0 remote IdP metadata for SimpleSAMLphp.
 *
 * Remember to remove the IdPs you don't use from this file.
 *
 * See: https://simplesamlphp.org/docs/stable/simplesamlphp-reference-idp-remote 
 */


$metadata['https://iam-stage.pearson.com:443/auth'] = array(
	'name' => array(
		'en' => 'Feide OpenIdP - guest users',
		'no' => 'Feide Gjestebrukere',
	),
	'description' => 'Here you can login with your account on Feide RnD OpenID. If you do not already have an account on this identity provider, you can create a new one by following the create new account link and follow the instructions.',

	'SingleSignOnService' => 'https://iam-stage.pearson.com:443/auth/SSORedirect/metaAlias/pearson/idp',
	'SingleLogoutService' => 'https://iam-stage.pearson.com:443/auth/IDPSloRedirect/metaAlias/pearson/idp',
	'certFingerprint' => '9bbec676cff86935b1d803596c96f1e697fdbff0'
);

