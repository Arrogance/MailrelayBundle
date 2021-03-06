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
use Arrogance\MailrelayBundle\ApiMethodInterface;

/**
 * Class EmailBase
 *
 * @package Arrogance\MailrelayBundle\Email
 * @author Manuel Raya <manuel@arrogance.es>
 */
abstract class EmailBase implements ApiMethodInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * Subject of the message.
     *
     * @var string
     */
    protected $subject;

    /**
     * Html of the message. There is no need to provide plain text as it is automatically generated based on the
     * provided html.
     *
     * @var string
     */
    protected $html;

    /**
     * Id of the mailbox that will be used on the From header. You can get all mailboxes using function.
     *
     * @var integer
     */
    protected $fromId;

    /**
     * Id of the mailbox that will be used on the Reply-To header. You can get all mailboxes using function.
     *
     * @var integer
     */
    protected $replyId;

    /**
     * Mailbox report id. You can get all mailboxes using function.
     *
     * @var integer
     */
    protected $reportId;

    /**
     * Id of the package used to send this email. You can get all packages using function.
     *
     * @var integer
     */
    protected $packageId;

    /**
     * Optional parameter in case you want to add attachments.
     *
     * @var mixed
     * @TODO Manuel: I don't know how to manage attachments yet.
     */
    protected $attachments;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

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
        return (integer) $this->fromId;
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
        return (integer) $this->replyId;
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
        return (integer) $this->reportId;
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
        return (integer) $this->packageId;
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
}