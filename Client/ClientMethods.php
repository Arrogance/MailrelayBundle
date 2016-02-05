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
        return $this->connection->get('getCampaigns', $options);
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
     * Get a list of campaign folders.
     *
     * @param array $options
     *
     * @return object The response
     */
    public function getCampaignFolders(array $options = [])
    {
        return $this->connection->get('getCampaignFolders', $options);
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
     * @param integer      $id
     * @param string       $name
     * @param null|integer $parentId
     *
     * @return object The response
     */
    public function updateCampaignFolder($id, $name, $parentId = null)
    {
        $options = [ 'id'  => $id, 'name' => $name ];
        if($parentId) {
            $options['parentId'] = $parentId;
        }

        return $this->connection->get('updateCampaignFolder', $options);
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
     * Get list of groups.
     *
     * @param array $options
     *
     * @return object The response
     */
    public function getGroups(array $options = [])
    {
        return $this->connection->get('getGroups', $options);
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