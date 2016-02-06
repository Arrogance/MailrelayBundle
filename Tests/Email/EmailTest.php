<?php

/*
 * This file is part of the Arrogance MailrelayBundle package.
 *
 * (c) Manuel Raya <manuel@arrogance.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arrogance\MailrelayBundle\Tests\Email;

use Arrogance\MailrelayBundle\Email\Email;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class EmailTest
 *
 * @package Arrogance\MailrelayBundle\Tests\Client
 * @author Manuel Raya <manuel@arrogance.es>
 */
class EmailTest extends WebTestCase
{
    public function testAddEmail()
    {
        $email = new Email();
        $email->addEmail('Test Email', 'test@test.io');

        $this->assertContains('test@test.io', $email->getEmails()[0]);
        $this->assertContains('Test Email', $email->getEmails()[0]);
    }

    public function testToArray()
    {
        $email = new Email();

        $this->assertCount(0, $email->toArray()['attachments']);
    }
}
