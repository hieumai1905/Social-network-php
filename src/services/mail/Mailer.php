<?php

namespace services\mail;
require_once 'src/vendor/autoload.php';

use Google;
use Google\Service\Gmail;
use services\Exception;

class Mailer
{
    private static function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function getClient()
    {
        $token_path = 'src/services/mail/lib/token.json';
        $client = new Google\Client();
        $client->setAuthConfig('src/services/mail/lib/credentials.json');
        $client->addScope(Google\Service\Gmail::GMAIL_SEND);
        if (file_exists($token_path)) {
            $client->setAccessToken(file_get_contents($token_path));
        } else {
            $auth_url = $client->createAuthUrl();
            echo "Open the following link in your browser:\n";
            echo $auth_url;
            $auth_code = readline("Enter the authorization code: ");
            $access_token = $client->fetchAccessTokenWithAuthCode($auth_code);
            $client->setAccessToken($access_token);
            file_put_contents($token_path, json_encode($access_token));
        }
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            file_put_contents($token_path, json_encode($client->getAccessToken()));
        }

        return $client;
    }

    public static function sendEmail($to, $subject, $messageBody)
    {
        $client = self::getClient();
        $service = new Gmail($client);
        $message = new Google\Service\Gmail\Message();

        $messageBodyHtml = '<html><body>' .

            '
                <div style="text-align: center">
                    <h1>Mã xác nhận của bạn là: ' . $messageBody . '</h1>
                </div>

                '

            . '</body></html>';

        $message->setRaw(self::base64url_encode(
            "To: $to\r\n" .
            "Subject: $subject\r\n" .
            "MIME-Version: 1.0\r\n" .
            "Content-Type: text/html; charset=utf-8\r\n\r\n" .
            $messageBodyHtml
        ));

        try {
            $service->users_messages->send('me', $message);
            echo "Email sent successfully.";
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }
}