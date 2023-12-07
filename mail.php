<?php


require_once (__DIR__ . '/vendor/composer/autoload_real.php');



   
   function sendEmail($emailToSend, $subject, $content){
       
       $config = ElasticEmail\Configuration::getDefaultConfiguration()->setApiKey('X-ElasticEmail-ApiKey', 'EC390BB040C5BF82C6C365A9E1B542F825CB4482A7D47F147458B0C2605593D9EEA5E82BCFDAE4F063FFBCAC3736461A');

       $apiInstance = new ElasticEmail\Api\EmailsApi(
              new GuzzleHttp\Client(),
              $config
          );

   $email_message_data = new \ElasticEmail\Model\EmailTransactionalMessageData([
       "recipients" => new \ElasticEmail\Model\TransactionalRecipient([
           "to" => [$emailToSend]
       ]),
       "content" => new \ElasticEmail\Model\EmailContent([
           "body" => [new \ElasticEmail\Model\BodyPart([
                   "content_type" => "HTML",
                   "content" => $content,
               ])
           ],
           "from" => "mkouelambou@gmail.com",
           "subject" => $subject,
       ]),
       "options" => new \ElasticEmail\Model\Options([
           "channel_name" => "My Channel"
       ])
   ]);
   $response = $apiInstance->emailsTransactionalPost($email_message_data);
   return $response;
}
?>