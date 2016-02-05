<?php

/*
 * This file is part of the Arrogance MailrelayBundle package.
 *
 * (c) Manuel Raya <manuel@arrogance.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arrogance\MailrelayBundle\Client;

use Arrogance\MailrelayBundle\Campaign\Campaign;
use Arrogance\MailrelayBundle\Campaign\CampaignFolder;
use Arrogance\MailrelayBundle\Connection\Connection;
use Arrogance\MailrelayBundle\Email\Email;
use Arrogance\MailrelayBundle\Group\Group;

/**
 * Class ClientMethods
 *
 * @package Arrogance\MailrelayBundle\Client
 * @author Manuel Raya <manuel@arrogance.es>
 */
abstract class ClientMethods
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * Set the return data type for several api functions.
     *
     * @param string $type Options: array, csv, xml, json.
     *
     * @return mixed
     */
    public function setReturnType($type)
    {
        return $this->connection->get('setReturnType', [ 'returnType' => $type ]);
    }

    /**
     * Get a list of smtp tags.
     *
     * @param array $options
     *
     * @return object The response
     */
    public function getSmtpTags(array $options = [])
    {
        return $this->connection->get('getSmtpTags', $options);
    }

    /**
     * Get sent messages processed by Mailrelay system.
     *
     * @param array $options
     *
     * @return object The response
     */
    public function getSends(array $options = [])
    {
        return $this->connection->get('getSends', $options);
    }

    /**
     * Get bounced messages within a specified date.
     *
     * @param string $date Date in the following format: YYYY-MM-DD
     * @param array  $options
     *
     * @return object The response
     */
    public function getDeliveryErrors($date, array $options = [])
    {
        return $this->connection->get('getDeliveryErrors', array_merge([ 'date' => $date ], $options));
    }

    /**
     * Get the full day log for a specified date.
     *
     * @param string $date Date in the following format: YYYY-MM-DD
     * @param array $options
     *
     * @return object The response
     */
    public function getDayLog($date, array $options = [])
    {
        return $this->connection->get('getDayLog', array_merge([ 'date' => $date ], $options));
    }

    /**
     * Get the number of messages sent to the specified recipient.
     *
     * @param string $email Recipient email
     * @param string $date Date in the following format: YYYY-MM-DD
     *
     * @return object The response
     */
    public function getMailRcptNumber($email, $date)
    {
        return $this->connection->get('getMailRcptNumber', [ 'email'  => $email, 'date' => $date ]);
    }

    /**
     * Get list of packages.
     *
     * @param array $options
     *
     * @return object The response
     */
    public function getPackages(array $options = [])
    {
        return $this->connection->get('getPackages', $options);
    }

    /**
     * Get a list of campaigns.
     *
     * @param array $options
     *
     * @return object The response
     */
    public function getCampaigns(array $options = [])
    {
        $response = $this->connection->get('getCampaigns', $options);

        $results = [];
        foreach($response->data as $object) {
            if($object) {
                $results[] = $this->objectToCampaign($object);
            }
        }

        return $results;
    }

    /**
     * Add new campaign.
     *
     * @param Campaign $campaign
     *
     * @return object The response
     */
    public function addCampaign(Campaign $campaign)
    {
        return $this->connection->get('addCampaign', $campaign->toArray());
    }

    /**
     * Update campaign.
     *
     * @param Campaign $campaign
     *
     * @return object The response
     */
    public function updateCampaign(Campaign $campaign)
    {
        return $this->connection->get('updateCampaign', $campaign->toArray());
    }

    /**
     * Delete campaign using its id.
     *
     * @param $id
     *
     * @return mixed
     */
    public function deleteCampaign($id)
    {
        return $this->connection->get('deleteCampaign', [ 'id' => $id ]);
    }

    /**
     * This function allows you to send a campaign to the groups that are assigned to them.
     * It will return an mailing list object. You can use this object to control mailing list with its respective
     * functions like and or get statistics.
     *
     * @param integer $id
     * @param array   $options
     *
     * @return object The response
     */
    public function sendCampaign($id, array $options = [])
    {
        return $this->connection->get('sendCampaign', array_merge([ 'id' => $id ], $options));
    }

    /**
     * This function allows you to send a campaign to a test email. It is normally used to verify if the campaign
     * content looks ok in email clients before sending it to customers.
     *
     * @param integer $id
     * @param string  $email
     *
     * @return object The response
     */
    public function sendCampaignTest($id, $email)
    {
        return $this->connection->get('sendCampaignTest', [ 'id' => $id, 'email' => $email ]);
    }

    /**
     * @param object $object
     *
     * @return Campaign
     */
    protected function objectToCampaign($object)
    {
        $campaignFolder = new Campaign();
        return $campaignFolder->setId($object->id)
            ->setSubject($object->subject)
            ->setFromId($object->mailbox_from_id)
            ->setReplyId($object->mailbox_reply_id)
            ->setReportId($object->mailbox_report_id)
            ->setGroups($object->groups)
            ->setAttachments(unserialize($object->attachs))
            ->setDate(new \DateTime($object->date))
            ->setCreated(new \DateTime($object->created))
            ->setLastSent(new \DateTime($object->last_sent))
            ->setDeleted((boolean) $object->deleted)
            ->setSendDate(new \DateTime($object->send_date))
            ->setSubscribersTotal($object->subscribers_total)
            ->setPackageId($object->package_id)
            ->setCampaignFolderId($object->id_campaign_folder)
            ->setAnalyticsUtmCampaign($object->analytics_utm_campaign);
    }

    /**
     * Get a list of campaign folders.
     *
     * @param array $options
     *
     * @return array
     */
    public function getCampaignFolders(array $options = [])
    {
        $response = $this->connection->get('getCampaignFolders', $options);

        $results = [];
        foreach($response->data as $object) {
            if($object) {
                $results[] = $this->objectToCampaignFolder($object);
            }
        }

        return $results;
    }

    /**
     * Add a campaign folder to our account.
     *
     * @param CampaignFolder $campaignFolder
     *
     * @return object The response
     */
    public function addCampaignFolder(CampaignFolder $campaignFolder)
    {
        return $this->connection->get('addCampaignFolder', $campaignFolder->toArray());
    }

    /**
     * Update campaign folder using its id.
     *
     * @param CampaignFolder $campaignFolder
     *
     * @return object The response
     */
    public function updateCampaignFolder(CampaignFolder $campaignFolder)
    {
        return $this->connection->get('updateCampaignFolder', $campaignFolder->toArray());
    }

    /**
     * Delete campaign folder using its id.
     *
     * @param integer $id
     *
     * @return object The response
     */
    public function deleteCampaignFolder($id)
    {
        return $this->connection->get('deleteCampaignFolder', [ 'id' => $id ]);
    }

    /**
     * @param object $object
     *
     * @return CampaignFolder
     */
    protected function objectToCampaignFolder($object)
    {
        $campaignFolder = new CampaignFolder();
        return $campaignFolder->setId($object->id)
            ->setName($object->name)
            ->setParentId($object->parent_id);
    }

    /**
     * Get list of groups.
     *
     * @param array $options
     *
     * @return array
     */
    public function getGroups(array $options = [])
    {
        $response = $this->connection->get('getGroups', $options);

        $results = [];
        foreach($response->data as $object) {
            if($object) {
                $results[] = $this->objectToGroup($object);
            }
        }

        return $results;
    }

    /**
     * Add a new group.
     *
     * @param Group $group
     *
     * @return object The response
     */
    public function addGroup(Group $group)
    {
        return $this->connection->get('addGroup', $group->toArray());
    }

    /**
     * Update a existing group.
     *
     * @param Group $group
     *
     * @return mixed
     */
    public function updateGroup(Group $group)
    {
        return $this->connection->get('updateGroup', $group->toArray());
    }

    /**
     * Delete group using its id.
     *
     * @param $id
     *
     * @return mixed
     */
    public function deleteGroup($id)
    {
        return $this->connection->get('removeGroup', [ 'id' => $id ]);
    }

    /**
     * @param object $object
     *
     * @return Group
     */
    protected function objectToGroup($object)
    {
        $group = new Group();
        return $group->setId($object->id)
            ->setName($object->name)
            ->setDescription($object->description)
            ->setEnable((boolean) $object->enable)
            ->setVisible((boolean) $object->visible);
    }

    /**
     * @param array $options
     *
     * @return object The response
     */
    public function getMailboxes(array $options = [])
    {
        return $this->connection->get('getMailboxes', $options);
    }

    /**
     * @param Email $email
     *
     * @return object The response
     */
    public function sendMail(Email $email)
    {
        return $this->connection->get('sendMail', $email->toArray());
    }
}