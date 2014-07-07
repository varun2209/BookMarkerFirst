<?php
$json = '{"inbox":[{"from":"55512351","date":"29\/03\/2010","time":"21:24:10","utcOffsetSeconds":3600,"recipients":[{"address":"55512351","name":"55512351","deliveryStatus":"notRequested"}],"body":"This is message text."},{"from":"55512351","date":"29\/03\/2010","time":"21:24:12","utcOffsetSeconds":3600,"recipients":[{"address":"55512351","name":"55512351","deliveryStatus":"notRequested"}],"body":"This is message text."},{"from":"55512351","date":"29\/03\/2010","time":"21:24:13","utcOffsetSeconds":3600,"recipients":[{"address":"55512351","name":"55512351","deliveryStatus":"notRequested"}],"body":"This is message text."},{"from":"55512351","date":"29\/03\/2010","time":"21:24:13","utcOffsetSeconds":3600,"recipients":[{"address":"55512351","name":"55512351","deliveryStatus":"notRequested"}],"body":"This is message text."}]}';
$data = json_decode($json);
print_r($data);

    foreach ($data->inbox as $note)
    {
      echo '<p>';
      echo 'From : ' . htmlspecialchars($note->from) . '<br />';
      echo 'Date : ' . htmlspecialchars($note->date) . '<br />';
      echo 'Time : ' . htmlspecialchars($note->time) . '<br />';
      echo 'Body : ' . htmlspecialchars($note->body) . '<br />';

        foreach($note->recipients as $recipient)
        {
            echo 'To (address) : ' . htmlspecialchars($recipient->address) . '<br />';
            echo 'To (name)    : ' . htmlspecialchars($recipient->name) . '<br />';
            echo 'Status       : ' . htmlspecialchars($recipient->deliveryStatus) . '<br />';
        }
    }
?>