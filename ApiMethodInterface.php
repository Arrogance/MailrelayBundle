<?php

/*
 * This file is part of the Arrogance MailrelayBundle package.
 *
 * (c) Manuel Raya <manuel@arrogance.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arrogance\MailrelayBundle;

/**
 * Interface ApiMethodInterface
 *
 * @package Arrogance\MailrelayBundle
 * @author Manuel Raya <manuel@arrogance.es>
 */
interface ApiMethodInterface
{
    public function toArray();
}