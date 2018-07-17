<?php

namespace N7olkachev\Envify\Test;

use PHPUnit\Framework\TestCase;

class EnvifyTest extends TestCase
{
    /** @test */
    public function it_works_without_prefix()
    {
        putenv('MAILGUN_DOMAIN=mailgun-domain');
        putenv('MAILGUN_SECRET=foo');
        putenv('SES_KEY=ses-key');
        putenv('REALLY_DEEP_ENV_VALUE=bar');

        $expected = [
            'mailgun' => [
                'domain' => 'mailgun-domain',
                'secret' => 'foo',
            ],
            'ses' => [
                'key' => 'ses-key',
                'secret' => null,
                'region' => 'us-east-1',
            ],
            'really' => [
                'deep' => [
                    'env' => [
                        'value' => 'bar',
                    ]
                ]
            ]
        ];

        $this->assertEquals($expected, envify([
            'mailgun' => [
                'domain',
                'secret',
            ],
            'ses' => [
                'key',
                'secret',
                'region' => 'us-east-1',
            ],
            'really' => [
                'deep' => [
                    'env' => [
                        'value',
                    ]
                ]
            ]
        ]));
    }

    /** @test */
    public function it_works_with_prefix()
    {
        putenv('APP_URL=test');

        $expected = [
            'name' => 'Laravel',
            'env' => 'production',
            'url' => 'test',
            'foo' => null,
        ];

        $this->assertEquals($expected, envify('app', [
            'name' => 'Laravel',
            'env' => 'production',
            'url',
            'foo',
        ]));
    }
}
