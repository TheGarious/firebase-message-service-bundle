<?php

/*
 * This file is part of the Firebase Service bundle.
 *
 * (c) Gary Houbre <gary.houbre@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ghoubre\FirebaseServiceBundle\Service;

use Exception;

/**
 * Class FirebaseService
 *
 * @author Gary HOUBRE <gary.houbre@gmail.com>
 *
 */
class FirebaseNotificationService
{
	protected $server_key;

	protected $content_available;

	protected $time_to_live;

	protected $message;

	const FCM_URL = "https://fcm.googleapis.com/fcm/send";

	public function __construct($server_key, $content_available = true, $time_to_live = 30)
    {
        $this->server_key = $server_key;
        $this->content_available = $content_available;
        $this->time_to_live = $time_to_live;
    }

    public function createMessage($message)
	{
		if (!array_key_exists("to", $message)) {
		    return false;
        }
        $this->message["to"] = $message["to"];


		if (array_key_exists("title", $message)) {
			$this->message["notification"]["title"] = $message["title"];
		}
		if (array_key_exists("body", $message)) {
			$this->message["notification"]["body"] = $message["body"];
		}
		if (array_key_exists("badge", $message)) {
			$this->message["notification"]["badge"] = $message["badge"];
		}
		if (array_key_exists("sound", $message)) {
			$this->message["notification"]["sound"] = $message["sound"];
		}
		if (array_key_exists("data", $message)) {
			$this->message["data"] = $message["data"];
		}

		$this->message["content_available"] = true;

		$this->message["time_to_live"] = 30;

		return true;
	}

	public function sendNotification()
	{
		$content = json_encode($this->message);

		$curl = curl_init(self::FCM_URL);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				"Content-type: application/json",
				"Authorization: key=".$this->server_key
			)
		);
        $curlConf["header"] = curl_getinfo($curl, CURLOPT_HEADER);

		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
		// @codeCoverageIgnoreStart
		$json_response = curl_exec($curl);
		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        // @codeCoverageIgnoreEnd
        curl_close($curl);

        return [
		    'curlConf'  => $curlConf,
            'status' 	=> $status,
            'response' 	=> $json_response
        ];
	}

	public function parseResult(array $result)
    {
        if ($result["status"] == 200) {
            return json_decode($result["response"], true);
        } elseif ($result["status"] == 400) {
            throw new Exception("Invalid fields or request not parsed as JSON");
        } elseif ($result["status"] == 401) {
            throw new Exception("Authenticate Error");
        } elseif ($result["status"] >= 500 && $result["status"] < 600) {
            throw new Exception("Internal error in the FCM connection server");
        } else {
            throw new Exception("Look status and check status in firebase.google.com");
        }
    }
}
