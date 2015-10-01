<?php

/**
 * Created by PhpStorm.
 * User: vmichnowicz
 * Date: 9/30/15
 * Time: 10:00 PM
 */
class RsaSha1SignatureTest extends PHPUnit_Framework_TestCase
{
    const IDENTIFIER = 'jira-identifier';
    const SECRET = 'jira-secret';
    const PRIVATE_KEY = '-----BEGIN RSA PRIVATE KEY-----
MIICWgIBAAKBgG84XD9ptPBn7RDtIZQkjaUwlNEUBWLt/N+Xi3kIxIF71uzVjzLq
ttjmYDWd0v5+skta5C8JneGrRhvrT+UN9bjvLDy5rulJR8irHtSsCUHm2fZM9aRD
mEcxNmwjbQ6J4bwfRJqkQK+BIedRlFHoD3pk0QcU6j+lxlUmo8dtsOGxAgMBAAEC
gYBhob4IxIhbST+nziHd48Cbs+vPJZ4c3AFRXbzHgNTPPaDLwiS0c6oS+RiXuHWR
hjKJR75rNCvt/+XJeGVoEzsR9lHKbJvCJCYx+4F/jA8qUBXXW0ru6SdnFmH0ToIY
SqqwsW07sXe4SXujEHKjvTE0aQWQEK2kdLnDtUiGqT+7SQJBAKmnKiGv3kb1TIMu
l5SWjf2bga6oXChfu9PJUH7KltH7vBI8jBeb4BZrEhQOcIgB92mU1vNjlTkgorXm
rqXMo6sCQQCn07mTvcvCYFdbaGFFVzW+SxYyRF9FmZFh0WnaBa2RK+R2F8KEHtgU
bpCfi66hPSmVNYImSecDD2fiBZ7oxjQTAkArX3xq/l5yf7Ye96NzLoaApughshNV
kxwfCiHVOJAUgSpU8zvRsV05/geyLvrgGriZOp81vGjjIQ/YN3DBHK9fAkARXrGD
YA55xLzl4gzHP3p5go3+j+MIcheA90qsXRAUyWUw786bHBIjMzpWuP9PAuSN4+bf
jaCSSYLn+sryrqjvAkA1MqtBWF5/WapLOjRDMo+Koxz1YMNAS7ZTbxVM0FJX1h9I
oUftP9M5SSjmR/OwCBJwGiqoiQtu3IALT6lBVLoE
-----END RSA PRIVATE KEY-----';
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
