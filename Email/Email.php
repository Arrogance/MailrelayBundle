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