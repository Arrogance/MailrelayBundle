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

        $emailsCollection = $email->getEmails();
        $this->assertContains('test@test.io', $emailsCollection[0]);
        $this->assertContains('Test Email', $emailsCollection[0]);
    }

    public function testPackageIdIsInteger()
    {
        $email = new Email();
        $email->setReplyId(10);

        $this->assertEquals($email->getReplyId(), 10);
        $this->assertInternalType('integer', $email->getReplyId());
    }
}
