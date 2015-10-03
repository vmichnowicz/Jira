<?php

/**
 * Created by PhpStorm.
 * User: vmichnowicz
 * Date: 9/30/15
 * Time: 10:00 PM
 */
class RsaSha1SignatureTest extends Base
{
    const SIGNATURE = 'Vr9+xQiv9M77aQmgZdPnMtEKKZF7/KWBc4+njMdU+Of0baz5XuNCScJhDq6kvEiqCJBItgr1uD1EpN1FSIaNLQZwYEqXLShGLzuucwGF4TckDPOzxsP46ybOusjevgNqFtSkblVH2Kk0P/33kPtSkPAh3xN8i19LEKQWNXpIMFU=';

    /**
     * Test invalid cert
     *
     * @expectedException \Exception
     */
    public function testInvalidCert()
    {
        $credentials = new \League\OAuth1\Client\Credentials\ClientCredentials();
        $credentials->setIdentifier('');
        $credentials->setSecret('');

        $path = tempnam(sys_get_temp_dir(), 'pem');

        $signature = new \SocialiteProviders\Jira\RsaSha1Signature($credentials);
        $signature->sign('http://example.com', [], 'POST', $path);
    }

    /**
     * Test valid cert
     */
    public function testValidCert()
    {
        $credentials = new \League\OAuth1\Client\Credentials\ClientCredentials();
        $credentials->setIdentifier('');
        $credentials->setSecret('');

        $path = tempnam(sys_get_temp_dir(), 'pem');

        file_put_contents($path, self::PRIVATE_KEY);

        $signature = new \SocialiteProviders\Jira\RsaSha1Signature($credentials);

        $this->assertEquals(self::SIGNATURE, $signature->sign('http://example.com', [], 'POST', $path));
    }

}
