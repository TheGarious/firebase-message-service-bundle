<?php

/*
 * This file is part of the Firebase Service Bundle.
 *
 * (c) Gary HOUBRE <gary.houbre@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ghoubre\FirebaseServiceBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class FirebaseServiceLog
 *
 * @author Gary HOUBRE <gary.houbre@gmail.com>
 */
abstract class FirebaseServiceLog
{
    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $serverKey;

    /**
     * @ORM\Column(type="text")
     */
    protected $body;

    /**
     * @ORM\Column(type="string", length=16)
     */
    protected $status;

    /**
     * @ORM\Column(type="text")
     */
    protected $firebaseLog;

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getFirebaseLog()
    {
        return $this->firebaseLog;
    }

    /**
     * @return mixed
     */
    public function getServerKey()
    {
        return $this->serverKey;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $body
     *
     * @return self
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param mixed $firebaseLog
     *
     * @return self
     */
    public function setFirebaseLog($firebaseLog)
    {
        $this->firebaseLog = $firebaseLog;

        return $this;
    }

    /**
     * @param mixed $serverKey
     *
     * @return self
     */
    public function setServerKey($serverKey)
    {
        $this->serverKey = $serverKey;

        return $this;
    }

    /**
     * @param mixed $status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

}
