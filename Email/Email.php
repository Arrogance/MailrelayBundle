<?php

/*
 * This file is part of the Arrogance MailrelayBundle package.
 *
 * (c) Manuel Raya <manuel@arrogance.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arrogance\MailrelayBundle\Email;


/**
 * Class Email
 *
 * @package Arrogance\MailrelayBundle\Email
 * @author Manuel Raya <manuel@arrogance.es>
 */
class Email extends EmailBase
{
    /**
     * Array with all recipients in the following format:
     *  array( 'name' => 'Name 1', 'email' => '' ),
     *  array( 'name' => 'Name 1', 'email' => '' )
     *
     * @var array
     */
    protected $emailCollection;

    /**
     * Email constructor.
     */
    public function __construct()
    {
        $this->emailCollection = array();
    }

    /**
     * @param string $email
     * @param string $name
     *
     * @return $this
     */
    public function addEmail($email, $name = '')
    {
        $this->emailCollection[] = array(
            'email' => $email,
            'name' => $name
        );

        return $this;
    }

    /**
     * @return array
     */
    public function getEmails()
    {
        return $this->emailCollection;
    }

    /**
     * @param array $emails
     *
     * @return Email
     */
    public function setEmails($emails)
    {
        $this->emailCollection = $emails;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = array(
            'emails' => $this->emailCollection,
            'subject' => $this->subject,
            'html' => $this->html,
            'mailboxFromId' => $this->fromId,
            'mailboxReplyId' => $this->replyId,
            'mailboxReportId' => $this->reportId,
            'packageId' => $this->packageId
        );

        if($this->attachments) {
            $array['attachments'] = $this->attachments;
        }

        return $array;
    }
}