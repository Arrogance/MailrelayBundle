<?php

/*
 * This file is part of the Arrogance MailrelayBundle package.
 *
 * (c) Manuel Raya <manuel@arrogance.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arrogance\MailrelayBundle\MailingList;

use Arrogance\MailrelayBundle\Email\EmailBase;

/**
 * Class MailingList
 *
 * @package Arrogance\MailrelayBundle\MailingList
 * @author Manuel Raya <manuel@arrogance.es>
 */
class MailingList extends EmailBase
{
    /**
     * Array containing groups id for this campaign. Example for groups 1 and 7: array( 1, 7 ).
     *
     * @var array
     */
    protected $groups;

    /**
     * Optional parameter to specify a plain text version. If not set, a text version will be automatically generated
     * from html.
     *
     * @var string
     */
    protected $text;

    /**
     * Optional parameter to set the utm_campaign for Google Analytics.
     *
     * @var string
     */
    protected $analyticsUtmCampaign;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var \DateTime
     */
    protected $lastSent;

    /**
     * @var boolean
     */
    protected $deleted;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var \DateTime
     */
    protected $startSent;

    /**
     * @var \DateTime
     */
    protected $sendDate;

    /**
     * @var integer
     */
    protected $subscribersTotal;

    /**
     * @var integer
     */
    protected $mailingListFolderId;

    /**
     * @var integer
     */
    protected $adminId;

    /**
     * @var integer
     */
    protected $campaignId;

    /**
     * @var mixed
     */
    protected $authToken;

    /**
     * @var boolean
     */
    protected $spam;

    /**
     * @var string
     */
    protected $spamReport;

    /**
     * @var integer
     */
    protected $sent;

    /**
     * @var integer
     */
    protected $bounced;

    /**
     * @return array
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param array $groups
     *
     * @return MailingList
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return MailingList
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getAnalyticsUtmCampaign()
    {
        return $this->analyticsUtmCampaign;
    }

    /**
     * @param string $analyticsUtmCampaign
     *
     * @return MailingList
     */
    public function setAnalyticsUtmCampaign($analyticsUtmCampaign)
    {
        $this->analyticsUtmCampaign = $analyticsUtmCampaign;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return MailingList
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     *
     * @return MailingList
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastSent()
    {
        return $this->lastSent;
    }

    /**
     * @param \DateTime $lastSent
     *
     * @return MailingList
     */
    public function setLastSent($lastSent)
    {
        $this->lastSent = $lastSent;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param boolean $deleted
     *
     * @return MailingList
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return MailingList
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartSent()
    {
        return $this->startSent;
    }

    /**
     * @param \DateTime $startSent
     *
     * @return MailingList
     */
    public function setStartSent($startSent)
    {
        $this->startSent = $startSent;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }

    /**
     * @param \DateTime $sendDate
     *
     * @return MailingList
     */
    public function setSendDate($sendDate)
    {
        $this->sendDate = $sendDate;

        return $this;
    }

    /**
     * @return int
     */
    public function getSubscribersTotal()
    {
        return $this->subscribersTotal;
    }

    /**
     * @param int $subscribersTotal
     *
     * @return MailingList
     */
    public function setSubscribersTotal($subscribersTotal)
    {
        $this->subscribersTotal = $subscribersTotal;

        return $this;
    }

    /**
     * @return int
     */
    public function getMailingListFolderId()
    {
        return $this->mailingListFolderId;
    }

    /**
     * @param int $mailingListFolderId
     *
     * @return MailingList
     */
    public function setMailingListFolderId($mailingListFolderId)
    {
        $this->mailingListFolderId = $mailingListFolderId;

        return $this;
    }

    /**
     * @return int
     */
    public function getAdminId()
    {
        return $this->adminId;
    }

    /**
     * @param int $adminId
     *
     * @return MailingList
     */
    public function setAdminId($adminId)
    {
        $this->adminId = $adminId;

        return $this;
    }

    /**
     * @return int
     */
    public function getCampaignId()
    {
        return $this->campaignId;
    }

    /**
     * @param int $campaignId
     *
     * @return MailingList
     */
    public function setCampaignId($campaignId)
    {
        $this->campaignId = $campaignId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @param mixed $authToken
     *
     * @return MailingList
     */
    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isSpam()
    {
        return $this->spam;
    }

    /**
     * @param boolean $spam
     *
     * @return MailingList
     */
    public function setSpam($spam)
    {
        $this->spam = $spam;

        return $this;
    }

    /**
     * @return string
     */
    public function getSpamReport()
    {
        return $this->spamReport;
    }

    /**
     * @param string $spamReport
     *
     * @return MailingList
     */
    public function setSpamReport($spamReport)
    {
        $this->spamReport = $spamReport;

        return $this;
    }

    /**
     * @return int
     */
    public function getSent()
    {
        return $this->sent;
    }

    /**
     * @param int $sent
     *
     * @return MailingList
     */
    public function setSent($sent)
    {
        $this->sent = $sent;

        return $this;
    }

    /**
     * @return int
     */
    public function getBounced()
    {
        return $this->bounced;
    }

    /**
     * @param int $bounced
     *
     * @return MailingList
     */
    public function setBounced($bounced)
    {
        $this->bounced = $bounced;

        return $this;
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }
}