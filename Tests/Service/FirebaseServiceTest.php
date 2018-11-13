<?php

namespace Ghoubre\FirebaseServiceBundle\Tests\Service;

use Ghoubre\FirebaseServiceBundle\Service\FirebaseNotificationService;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class FirebaseServiceTest extends TestCase
{
    public function testSendNotification()
    {
        $firebaseService = $this->getFirebaseNotificationService();

        $rightMessage = array("to" => "test");
        $firebaseService->createMessage($rightMessage);

        $this->assertEquals(true, array_key_exists("curlConf", $firebaseService->sendNotification()));
    }

    public function testCreateMessageError()
    {
        $firebaseService = $this->getFirebaseNotificationService();

        $wrongMessage = array("from" => "test");
        $this->assertEquals(false, $firebaseService->createMessage($wrongMessage));
    }

    public function testCreateMessageSuccess()
    {
        $firebaseService = $this->getFirebaseNotificationService();

        $rightMessage = array("to" => "test");

        $this->assertEquals(true, $firebaseService->createMessage($rightMessage));
    }

    public function testSuccess200SendingNotification()
    {
        $firebaseService = $this->getFirebaseNotificationService();

        $result = [
          "status" => 200,
          "response" => "OK"
        ];

        $this->assertEquals(json_decode("OK", true), $firebaseService->parseResult($result));
    }

    public function testError400SendingNotification()
    {
        $firebaseService = $this->getFirebaseNotificationService();

        $result = [
            "status" => 400,
            "response" => "OK"
        ];

        try {
            $firebaseService->parseResult($result);
        } catch (\Exception $exception) {
            $this->assertEquals("Invalid fields or request not parsed as JSON", $exception->getMessage());
        }
    }

    public function testError401SendingNotification()
    {
        $firebaseService = $this->getFirebaseNotificationService();

        $result = [
            "status" => 401,
            "response" => "OK"
        ];

        try {
            $firebaseService->parseResult($result);
        } catch (\Exception $exception) {
            $this->assertEquals("Authenticate Error", $exception->getMessage());
        }
    }

    public function testError500SendingNotification()
    {
        $firebaseService = $this->getFirebaseNotificationService();

        $result = [
            "status" => 500,
            "response" => "OK"
        ];

        try {
            $firebaseService->parseResult($result);
        } catch (\Exception $exception) {
            $this->assertEquals("Internal error in the FCM connection server", $exception->getMessage());
        }
    }

    public function testErrorOtherSendingNotification()
    {
        $firebaseService = $this->getFirebaseNotificationService();

        $result = [
            "status" => 0,
            "response" => "OK"
        ];

        try {
            $firebaseService->parseResult($result);
        } catch (\Exception $exception) {
            $this->assertEquals("Look status and check status in firebase.google.com", $exception->getMessage());
        }
    }

    private function getFirebaseNotificationService()
    {
        return new FirebaseNotificationService("server_key");
    }
}
