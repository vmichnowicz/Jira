<?php

/**
 * Created by PhpStorm.
 * User: vmichnowicz
 * Date: 9/30/15
 * Time: 10:34 PM
 */
class ServerTest extends Base
{

    /**
     * Make sure user details is an object
     *
     * @TODO fix exception
     */
    public function testUserDetailsType()
    {
        $path = tempnam(sys_get_temp_dir(), 'pem');

        file_put_contents($path, self::PRIVATE_KEY);

        $array = array(
            'base_url' => 'http://example.com/',
            'cert' => $path,
            'identifier' => self::IDENTIFIER,
            'secret' => self::SECRET,
        );

        $server = new \SocialiteProviders\Jira\Server($array);

        $temp = new \League\OAuth1\Client\Credentials\TemporaryCredentials();
        $temp->setIdentifier(self::IDENTIFIER);

        $token = $server->getTokenCredentials($temp, self::IDENTIFIER, '');

        $data = [
            'name' => 'john doe',
            'email' => 'jdoe@example.com',
        ];

        $this->assertInstanceOf('\League\OAuth1\Client\Server\User', $server->userDetails($data, $token));
    }
}
