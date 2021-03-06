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
use Arrogance\MailrelayBundle\MailingList\MailingList;
use Arrogance\MailrelayBundle\Subscriber\Subscriber;

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
     * Get a list of smtp tags.
     *
     * @param array $options
     *
     * @return object The response
     */
    public function getSmtpTags(array $options = array())
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
    public function getSends(array $options = array())
    {
        $response = $this->connection->get('getSends', $options);

        return $response->data;
    }

    /**
     * Get bounced messages within a specified date.
     *
     * @param string $date Date in the following format: YYYY-MM-DD
     * @param array  $options
     *
     * @return object The response
     */
    public function getDeliveryErrors($date, array $options = array())
    {
        return $this->connection->get('getDeliveryErrors', array_merge(array('date' => $date), $options));
    }

    /**
     * Get the full day log for a specified date.
     *
     * @param string $date Date in the following format: YYYY-MM-DD
     * @param array $options
     *
     * @return object The response
     */
    public function getDayLog($date, array $options = array())
    {
        return $this->connection->get('getDayLog', array_merge(array('date' => $date), $options));
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
        return $this->connection->get('getMailRcptNumber', array('email' => $email, 'date' => $date));
    }

    /**
     * Get list of packages.
     *
     * @param array $options
     *
     * @return object The response
     */
    public function getPackages(array $options = array())
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
    public function getCampaigns(array $options = array())
    {
        $response = $this->connection->get('getCampaigns', $options);

        $results = array();
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
     * @param bool     $returnObject
     *
     * @return mixed|object
     */
    public function addCampaign(Campaign $campaign, $returnObject = false)
    {
        $response = $this->connection->get('addCampaign', $campaign->toArray());

        if($returnObject == true) {
            $result = $this->getCampaigns(array('id' => $response->data));
            return $result[0];
        }

        return $response;
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
        return $this->connection->get('deleteCampaign', array('id' => $id));
    }

    /**
     * This function allows you to send a campaign to the groups that are assigned to them.
     * It will return an mailing list id. You can use this id to control mailing list with its respective
     * functions like and or get statistics.
     *
     * @param integer $id
     * @param array   $options
     * @param bool    $returnObject
     *
     * @return mixed
     */
    public function sendCampaign($id, array $options = array(), $returnObject = false)
    {
        $response = $this->connection->get('sendCampaign', array_merge(array('id' => $id), $options));

        if($returnObject == true) {
            $result = $this->getMailingLists(array('id' => $response->data));
            return $result[0];
        }

        return $response;
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
        return $this->connection->get('sendCampaignTest', array('id' => $id, 'email' => $email));
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
     * Get a list of mailing lists.
     *
     * @param array $options
     *
     * @return array
     */
    public function getMailingLists(array $options = array())
    {
        $response = $this->connection->get('getMailingLists', $options);

        $results = array();
        foreach($response->data as $object) {
            if($object) {
                $results[] = $this->objectToMailingList($object);
            }
        }

        return $results;
    }

    /**
     * Cancel mailing list using its id. Note that once cancelled you cannot resume the mailing list.
     *
     * @param integer $id
     *
     * @return object The response
     */
    public function cancelMailingList($id)
    {
        return $this->connection->get('cancelMailingList', array('id' => $id));
    }

    /**
     * Pause mailing list using its id. You can resume it later using resumeMailingList function.
     *
     * @param integer $id
     *
     * @return object The response
     */
    public function pauseMailingList($id)
    {
        return $this->connection->get('pauseMailingList', array('id' => $id));
    }

    /**
     * Resume mailing list using its id. Mailing lists are only resumed if their current status is paused.
     *
     * @param integer $id
     *
     * @return object The response
     */
    public function resumeMailingList($id)
    {
        return $this->connection->get('resumeMailingList', array('id' => $id));
    }

    /**
     * @param $object
     *
     * @return MailingList
     */
    protected function objectToMailingList($object)
    {
        $mailingList = new MailingList();
        return $mailingList->setId($object->id)
            ->setSubject($object->subject)
            ->setFromId($object->mailbox_from_id)
            ->setReplyId($object->mailbox_reply_id)
            ->setReportId($object->mailbox_report_id)
            ->setGroups($object->groups)
            ->setText($object->text)
            ->setHtml($object->html)
            ->setAttachments(unserialize($object->attachs))
            ->setDate(new \DateTime($object->date))
            ->setCreated(new \DateTime($object->created))
            ->setLastSent(new \DateTime($object->last_sent))
            ->setDeleted((boolean) $object->deleted)
            ->setSendDate(new \DateTime($object->send_date))
            ->setSubscribersTotal($object->subscribers_total)
            ->setPackageId($object->package_id)
            ->setAnalyticsUtmCampaign($object->analytics_utm_campaign)
            ->setStatus($object->status)
            ->setAdminId($object->admin_id)
            ->setSpam($object->is_spam)
            ->setSpamReport($object->spam_report)
            ->setAuthToken($object->auth_token)
            ->setSent($object->sent)
            ->setBounced($object->bounced)
            ->setCampaignId($object->campaign_id)
            ->setMailingListFolderId($object->id_mailing_list_folder);
    }

    /**
     * Get a list of campaign folders.
     *
     * @param array $options
     *
     * @return array
     */
    public function getCampaignFolders(array $options = array())
    {
        $response = $this->connection->get('getCampaignFolders', $options);

        $results = array();
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
        return $this->connection->get('deleteCampaignFolder', array('id' => $id));
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
    public function getGroups(array $options = array())
    {
        $response = $this->connection->get('getGroups', $options);

        $results = array();
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
     * @param bool  $returnObject
     *
     * @return mixed
     */
    public function addGroup(Group $group, $returnObject = false)
    {
        $response = $this->connection->get('addGroup', $group->toArray());

        if($returnObject == true) {
            $result = $this->getGroups(array('id' => $response->data));
            return $result[0];
        }

        return $response;
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
        return $this->connection->get('removeGroup', array('id' => $id));
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
     * Get a list of subscribers.
     *
     * @param array $options
     *
     * @return mixed
     */
    public function getSubscribers(array $options = array())
    {
        return $this->connection->get('getSubscribers', $options);
    }

    /**
     * Add a new subscriber.
     *
     * @param Subscriber $subscriber
     * @param bool       $returnObject
     *
     * @return mixed
     */
    public function addSubscriber(Subscriber $subscriber, $returnObject = false)
    {
        $response = $this->connection->get('addSubscriber', $subscriber->toArray());

        if($returnObject == true) {
            $result = $this->getCampaigns(array('id' => $response->data));
            return $result[0];
        }

        return $response;
    }

    /**
     * Update subscriber data.
     *
     * @param Subscriber $subscriber
     *
     * @return mixed
     */
    public function updateSubscriber(Subscriber $subscriber)
    {
        return $this->connection->get('updateSubscriber', $subscriber->toArray());
    }

    /**
     * @param array $ids
     * @param bool  $activated
     *
     * @return mixed
     */
    public function updateSubscribers(array $ids, $activated = true)
    {
        return $this->connection->get('updateSubscribers', array(
            'ids' => $ids,
            'status' => $activated ? 1 : 0
        ));
    }

    /**
     * @param string $email
     *
     * @return mixed
     */
    public function deleteSubscriber($email)
    {
        return $this->connection->get('deleteSubscriber', array('email' => $email));
    }

    /**
     * Assign multiple subscribers to one or more groups. If the subscriber already exists, the new groups will be
     * merged with the current ones.
     *
     * @param array $groups
     * @param array $emails
     *
     * @return mixed
     */
    public function assignSubscribersToGroups(array $groups, array $emails)
    {
        return $this->connection->get('assignSubscribersToGroups', array(
            'groups' => $groups,
            'subscribers' => $emails
        ));
    }

    /**
     * @param array $options
     *
     * @return object The response
     */
    public function getMailboxes(array $options = array())
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

    /**
     * This function can be used to import subscribers with CSV files.
     *
     * @param string $content
     * @param array  $groups
     * @param array  $options
     *
     * @return object The response
     */
    public function import($content, array $groups, array $options = array())
    {
        return $this->connection->get('import', array_merge(array(
            'fileContent' => $content,
            'groups' => $groups
        ), $options));
    }

    /**
     * Get list of imports.
     *
     * @param array $options
     *
     * @return object The response
     */
    public function getImports(array $options = array())
    {
        return $this->connection->get('getImports', $options);
    }

    /**
     * Get details about an import showing line by line results.
     *
     * @param integer $id
     * @param array   $options
     *
     * @return object The response
     */
    public function getImportData($id, array $options = array())
    {
        return $this->connection->get('getImportData', array_merge(array('idFile' => $id), $options));
    }

    /**
     * Get basic mailing list stats containing number of views, clicks, sent emails, bounced, spam reports and
     * total subscribers.
     *
     * @param array $options
     *
     * @return object The response
     */
    public function getStats(array $options = array())
    {
        return $this->connection->get('getStats', $options);
    }

    /**
     * Get detailed clicks info for mailing lists.
     *
     * @param array $options
     *
     * @return object The response
     */
    public function getClicksInfo(array $options = array())
    {
        return $this->connection->get('getClicksInfo', $options);
    }

    /**
     * Get detailed unique clicks info for mailing lists.
     *
     * @param array $options
     *
     * @return mixed
     */
    public function getUniqueClicksInfo(array $options = array())
    {
        return $this->connection->get('getUniqueClicksInfo', $options);
    }

    /**
     * Get detailed impressions info for mailing lists.
     *
     * @param array $options
     *
     * @return mixed
     */
    public function getImpressionsInfo(array $options = array())
    {
        return $this->connection->get('getImpressionsInfo', $options);
    }

    /**
     * Get detailed unique impressions info for mailing lists.
     *
     * @param array $options
     *
     * @return mixed
     */
    public function getUniqueImpressionsInfo(array $options = array())
    {
        return $this->connection->get('getUniqueImpressionsInfo', $options);
    }
}