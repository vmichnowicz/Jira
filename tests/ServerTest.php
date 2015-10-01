<?php

/**
 * Created by PhpStorm.
 * User: vmichnowicz
 * Date: 9/30/15
 * Time: 10:34 PM
 */
class ServerTest extends PHPUnit_Framework_TestCase
{

    public function testUserDetailsType()
    {
        $credentials = new \League\OAuth1\Client\Credentials\ClientCredentials();
        $credentials->setIdentifier('');
        $credentials->setSecret('');

        $server = new \SocialiteProviders\Jira\Server($credentials);

        $data = [
            'name' => 'john doe',
            'email' => 'jdoe@example.com',
        ];
        
        $this->assertInstanceOf('\League\OAuth1\Client\Server\User', $server->userDetails($data));
    }
}
