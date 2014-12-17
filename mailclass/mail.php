<?php  
/*
 * Mail class
 * @author Ruud Verbij
 * @version 1.0
 * @usage at the bottom
 */

class mailer {
    private $afzender;
    private $type;
    private $ontvanger;
    private $bericht;
    private $headers;
    private $onderwerp;

    const TEXT = 1;
    const HTML = 2;

    /*
     * Constructor
     * @param $type = self::HTML or self::TEXT
     * adds content-type, x-priority, x-mailer, MIME-version headers
     */
    public function __construct($type = self::TEXT) {
         $this->type = $type;
         $this->addHeader('MIME-Version: 1.0');

         $this->addHeader('X-Priority: 3');
         $this->addHeader('X-MSMail-Priority: Normal');
         $this->addHeader('X-Mailer: PHP/'.phpversion());
    }

    /*
     * returns type
     * @return self::HTML or self::TEXT
     */
    public function getType() {
         return $this->type;
    }

    /*
     * sets type
     * @param $type = self::HTML or self::TEXT
     * returns false if $type is neither of both
     */
    public function setType($type = self::TEXT) {
         if($type != self::HTML && $type != self::TEXT) {
             $this->type = self::TEXT;
             return false;
         } else
             $this->type = $type;
    }

    /*
     * adds header
     * @param $header = string header
     */
    public function addHeader($header) {
         $this->headers[] = $header;
    }

    /*
     * sets header (overwrites all headers)
     * @param $headers = array with integer index
     */
    public function setHeaders($headers) {
         $this->headers = $headers;
    }

    /*
     * returns array with integer index
     */
    public function getHeaders() {
         return $this->headers;
    }

    /*
     * adds a receiver
     */
    public function addReceiver($receiver) {
         $this->ontvangers[] = $receiver;
    }

    /*
     * sets receivers (overwrites all receivers)
     * @param $receivers = array with integer index
     */
    public function setReceivers($receivers) {
         $this->ontvangers = $receivers;
    }

    /*
     * returns receiver with index '$which'
     * @param $which = all || integer index
     * if param $which exceeds array index of receivers; returns the latest set receiver
     */
    public function getReceivers($which = all) {
         if($which == "all")
              return $this->ontvangers;
         elseif($which < count($this->ontvangers))
              return $this->ontvangers[$which];
         else
              return $this->ontvangers[count($this->ontvangers)-1];
    }

    /*
     * sets subject
     */
    public function setSubject($subject) {
         $replaceArray = array("\n","\r");
         $subject = str_replace($replaceArray,"",$subject);
         $this->onderwerp = $subject;
    }

    /*
     * returns subject
     */
    public function getSubject() {
         return $this->onderwerp;
    }

    /*
     * sets sender with $mail and $name
     * @param $mail and $name = string
     */
    public function setSender($mail,$name) {
         $replaceArray = array("\n","\r");
         $name = str_replace($replaceArray,"",$name);
         $mail = str_replace($replaceArray,"",$mail);
         $this->addHeader('From: '.$name.' <'.$mail.'>');
         $this->afzender['email'] = $mail;
         $this->afzender['name']  = $name;
    }

    /*
     * returns sender
     * @return array with key index 'name' and 'email'
     */
    public function getSender() {
         return $this->afzender;
    }

    /*
     * sets message
     */
    public function setMessage($message) {
         $this->bericht = $message;
    }

    /*
     * returns message
     */
    public function getMessage() {
         return $this->bericht;
    }

    /*
     * sends email with subject, sender, message and all receivers
     * returns boolean if succeeded
     */
    public function send() {
         switch($this->type) {
              case self::HTML:
                    $this->addHeader('Content-Type: text/html; charset=iso-8859-1');
                    break;
              case self::TEXT:
              default:
                    $this->addHeader('Content-type: text/plain; charset=iso-8859-1');
         }
         $header;
         for($i=0;$i<count($this->headers);$i++)
              $header .= $this->headers[$i] . "\r\n";
         $header = substr($header,0,strlen($header)-2);
         $result = true;
         for($i=0;$i<count($this->ontvangers);$i++)
              if(!mail($this->ontvangers[$i],$this->titel,$this->bericht,$header))
                   $result = false;
         return $result;
    }

    /*
     * returns total email
     * @return array with key-indexes; 'sender-name',
     *                                 'sender-email',
     *                                 'subject',
     *                                 'message',
     *                                 'receivers'(array with integer index),
     *                                 'headers'(array with integer index)
     */
    public function getTotalEmail() {
         $result;
         $sender = $this->getSender();
         $result['sender-name']  = $sender['name'];
         $result['sender-email'] = $sender['email'];
         $result['subject']      = $this->getSubject();
         $result['message']      = $this->getMessage();
         $result['receivers']    = $this->getReceivers();
         $result['headers']      = $this->getHeaders();
         return $result;
    }

    private function headerSave($header) {
         $header = str_replace("<","&lt;",$header);
         return str_replace(">","&gt;",$header);
    }

    private function headerUnsave($header) {
         $header = str_replace("&lt;","<",$header);
         return str_replace("&gt;",">",$header);
    }

    /*
     * saves total email(sender-name,sender-email,subject,message,receivers,headers)
     * returns boolean true, false if succeeded
     */
    public function saveTotalEmail($filename) {
         $email = $this->getTotalEmail();
         $file = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?><rss version=\"2.0\"><channel>";
         $file .= "<title>Email</title><language>nl</language><description>Saved email</description>";
         $file .= "<item>\n\t<sender>\n\t\t<name>".$email['sender-name']."</name>\n\t\t<address>".$email['sender-email'];
         $file .= "</address>\n\t</sender>\n\t<subject>".$email['subject']."</subject>\n\t<headers>";
         for($i=0;$i<count($email['headers']);$i++)
             $file .= $this->headerSave($email['headers'][$i]) . ", ";
         $file = substr($file,0,strlen($file)-2);
         $file .= "</headers>\n";
         for($i=0;$i<count($email['receivers']);$i++)
             $file .= "\t<receiver>".$email['receivers'][$i]."</receiver>\n";
         $file .= "\t<message>\n\t\t".$email['message']."\n\t</message>\n</item>";
         $file .= "</channel></rss>";

         $handle = fopen($filename,'w');
         $done = fwrite($handle,$file);
         fclose($handle);
         return ($done == false) ? false : true;
    }

    /*
     * opens total email(sender-name,sender-email,subject,message,receivers,headers)
     */
    public function openTotalEmail($filename) {
         $source  = file_get_contents($filename);
         $begin   = strpos($source,"<item>");
         $begin   = strpos($source, "<name>", $begin) + strlen("<name>");
         $senderName  = substr($source, $begin, strpos($source, "</name>", $begin) - $begin);
         $begin   = strpos($source, "<address>",$begin) + strlen("<address>");
         $senderEmail = substr($source, $begin, strpos($source, "</address>", $begin) - $begin);
         $begin   = strpos($source, "<subject>", $begin) + strlen("<subject>");
         $subject = substr($source, $begin, strpos($source, "</subject>", $begin) - $begin);
         $begin   = strpos($source, "<headers>", $begin) + strlen("<headers>");
         $headers = explode(", ", $this->headerUnsave(substr($source, $begin, strpos($source, "</headers>", $begin) - $begin)));
         $aantalReceivers = str_word_count("<receiver>");
         $receivers;
         for($i = 0; $i < $aantalReceivers; $i++) {  
             $begin   = strpos($source, "<receiver>", $begin) + strlen("<receiver>");
             $receivers[] = substr($source, $begin, strpos($source, "</receiver>", $begin) - $begin);
         }
         $begin   = strpos($source, "<message>", $begin) + strlen("<message>");
         $message = substr($source, $begin, strpos($source, "</message>", $begin) - $begin);
         $type;
         for($i = 0; $i < count($headers); $i++)
             if(strpos($headers[$i], "Content-Type: text/") >= 1) {
                 $begin = strpos($headers[$i], "Content-Type: text/")+strlen("Content-Type: text/");
                 $type = substr($headers[$i], $begin, strpos($headers[$i],";",$begin) - $begin);
                 $headers[$i] = "";
             }
         switch($type) {
             case "plain" : $type = TEXT; break;
             case "html"  : $type = HTML; break;
             default      : $type = TEXT;
         }

         $this->setType($type);
         $this->setHeaders($headers);
         $this->setReceivers($receivers);
         $this->setSubject($subject);
         $this->setSender($senderEmail,$senderName);
         $this->setMessage($message);
    }
}
?>

<?php
/* Usage */
$mail = new mailer();
$mail->addReceiver("info@vdsteltvormgeving.nl");
$mail->setSender("sandervdstelt@msn.com","SANDER");
$mail->setSubject("Dit is een test vanuit mail class");
$mail->setMessage("Test 1.0 || 17-12-2014");

$mail->saveTotalEmail("blaat.txt");
$mailer = new mailer();
$mailer->openTotalEmail("blaat.txt");
$mailer->saveTotalEmail("mailTest.txt");

print_r('het werkt!');
?>