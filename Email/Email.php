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
class Email
{
    /**
     * @var array
     */
    protected $emailCollection;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $html;

    /**
     * @var integer
     */
    protected $fromId;

    /**
     * @var integer
     */
    protected $replyId;

    /**
     * @var integer
     */
    protected $reportId;

    /**
     * @var integer
     */
    protected $packageId;

    /**
     * @var mixed
     * @TODO Manuel: I don't know how to manage attachments yet.
     */
    protected $attachments;

    /**
     * Email constructor.
     */
    public function __construct()
    {
        $this->emailCollection = [];
    }

    /**
     * @param string $name
     * @param string $email
     *
     * @return $this
     */
    public function addEmail($name, $email)
    {
        $this->emailCollection[] = [
            'name' => $name,
            'email' => $email
        ];

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
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     *
     * @return Email
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param string $html
     *
     * @return Email
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * @return int
     */
    public function getFromId()
    {
        return $this->fromId;
    }

    /**
     * @param int $fromId
     *
     * @return Email
     */
    public function setFromId($fromId)
    {
        $this->fromId = $fromId;

        return $this;
    }

    /**
     * @return int
     */
    public function getReplyId()
    {
        return $this->replyId;
    }

    /**
     * @param int $replyId
     *
     * @return Email
     */
    public function setReplyId($replyId)
    {
        $this->replyId = $replyId;

        return $this;
    }

    /**
     * @return int
     */
    public function getReportId()
    {
        return $this->reportId;
    }

    /**
     * @param int $reportId
     *
     * @return Email
     */
    public function setReportId($reportId)
    {
        $this->reportId = $reportId;

        return $this;
    }

    /**
     * @return int
     */
    public function getPackageId()
    {
        return $this->packageId;
    }

    /**
     * @param int $packageId
     *
     * @return Email
     */
    public function setPackageId($packageId)
    {
        $this->packageId = $packageId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param mixed $attachments
     *
     * @return Email
     */
    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = [
            'emails' => $this->emailCollection,
            'subject' => $this->subject,
            'html' => $this->html,
            'mailboxFromId' => $this->fromId,
            'mailboxReplyId' => $this->replyId,
            'mailboxReportId' => $this->reportId,
            'packageId' => $this->packageId
        ];

        if($this->attachments) {
            $array['attachments'] = $this->attachments;
        }

        return $array;
    }
}