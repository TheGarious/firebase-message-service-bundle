<?php

namespace ghoubre\FirebaseServiceBundle\Tests\Model;

use ghoubre\FirebaseServiceBundle\Model\FirebaseServiceLog;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class FirebaseServiceLogTest extends TestCase
{

    public function testServerKey()
    {
        $firebaseServiceLog = $this->getFirebase();
        $firebaseServiceLog->setServerKey("servey_key");
        $this->assertEquals("servey_key", $firebaseServiceLog->getServerKey());
    }

    public function testBody()
    {
        $firebaseServiceLog = $this->getFirebase();
        $firebaseServiceLog->setBody("firebase_service_log_body");
        $this->assertEquals("firebase_service_log_body", $firebaseServiceLog->getBody());
    }

    public function testStatus()
    {
        $firebaseServiceLog = $this->getFirebase();
        $firebaseServiceLog->setStatus(200);
        $this->assertEquals(200, $firebaseServiceLog->getStatus());
    }

    public function testFirebaseLog()
    {
        $firebaseServiceLog = $this->getFirebase();
        $firebaseServiceLog->setFirebaseLog("firebase_service_log");
        $this->assertEquals("firebase_service_log", $firebaseServiceLog->getFirebaseLog());
    }

    protected function getFirebase()
    {
        return $this->getMockForAbstractClass(FirebaseServiceLog::class);
    }
}
