<?php

/*
 * This file is part of the Arrogance MailrelayBundle package.
 *
 * (c) Manuel Raya <manuel@arrogance.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arrogance\MailrelayBundle\Campaign;

use Arrogance\MailrelayBundle\Email\EmailBase;

/**
 * Class Campaign
 *
 * @package Arrogance\MailrelayBundle\Campaign
 * @author Manuel Raya <manuel@arrogance.es>
 */
class Campaign extends EmailBase
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
     * Optional parameter to store campaign’s folder id. If not set, it will be stored at the API folder.
     *
     * @var integer
     */
    protected $campaignFolderId;

    /**
     * Add tokens to all tracked urls. If not set, it will be false.
     *
     * @var boolean
     */
    protected $urlToken;

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
     * @var \DateTime
     */
    protected $sendDate;

    /**
     * @var integer
     */
    protected $subscribersTotal;

    /**
     * Email constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->urlToken = false;
        $this->groups = [];
    }

    /**
     * @param integer $group
     *
     * @return $this
     */
    public function addGroup($group)
    {
        $this->groups[] = $group;

        return $this;
    }

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
     * @return Campaign
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
     * @return Campaign
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return int
     */
    public function getCampaignFolderId()
    {
        return $this->campaignFolderId;
    }

    /**
     * @param int $campaignFolderId
     *
     * @return Campaign
     */
    public function setCampaignFolderId($campaignFolderId)
    {
        $this->campaignFolderId = $campaignFolderId;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isUrlToken()
    {
        return $this->urlToken;
    }

    /**
     * @param boolean $urlToken
     *
     * @return Campaign
     */
    public function setUrlToken($urlToken)
    {
        $this->urlToken = $urlToken;

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
     * @return Campaign
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
     * @return Campaign
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
     * @return Campaign
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
     * @return Campaign
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
     * @return Campaign
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

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
     * @return Campaign
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
     * @return Campaign
     */
    public function setSubscribersTotal($subscribersTotal)
    {
        $this->subscribersTotal = $subscribersTotal;

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
            'packageId' => $this->packageId,
            'groups' => $this->groups,
            'urlToken' => $this->urlToken
        );

        $optional = array(
            'attachments' => $this->attachments,
            'text' => $this->text,
            'campaignFolderId' => $this->campaignFolderId,
            'analyticsUtmCampaign' => $this->analyticsUtmCampaign
        );

        foreach($optional as $name => $value) {
            if($value) {
                $array[$name] = $value;
            }
        }

        return $array;
    }
}