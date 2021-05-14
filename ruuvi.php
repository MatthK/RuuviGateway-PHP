<?php
    //connect and select the database
	
	try {
	  $host = "ComputerName\SQLEXPRESS";
      $instance = "SQLEXPRESS";
	  $port = 1433;
	  $dbname = "Ruuvi";
      $username = "RuuviUser";
      $pw = "strongPassword";
      $db = new PDO ("dblib:host=$host;dbname=$dbname","$username","$pw");
    } catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\r\n";
      exit;
    }

    // get the contents of the JSON file 
    $json = file_get_contents('php://input');
    
    // write the JSON to a text file
    // Optional for debugging. Make sure the file exists and has the necessary permissions set (everyone read/write)
 	$fp = fopen('/volume1/path-of-website/ruuvi.txt', 'w');
	fwrite($fp, $json."\n");
    fclose($fp);

    //decode JSON data to PHP array
    $obj = json_decode($json,true);
    
    //Fetch the details of JSON
    $js_tag = $obj['tags'];
    $js_ble = $obj['batteryLevel'];
    $js_did = $obj['deviceId'];
    $js_loc = $obj['location'];
    //$js_eid = $obj['eventId'];
    //$js_dat = $obj['Date'];

    // write the SQL String to a file - Open the file
    // Optional for debugging. Make sure the file exists and has the necessary permissions set (everyone read/write)
	$fpd = fopen('/volume1/path-of-website/ruuvid.txt', 'w');

    // Prepare the header of the insert
    $query = "INSERT INTO tbl_tempRuuvi(ItemID, Name, SeqNo, Temperature, Pressure, Humidity, Rssi, txPower, Voltage, MovCounter, accelX, accelY, accelZ, TempTime, deviceID, batteryLevel, lat, lon) \r\nVALUES ";
    // Go through each record in the tags
	foreach($js_tag as $key => $val)
    {
	   // Add a comma, if it is not the first record	
	   if ($key <> 0)
		   $query .= ",";
	   // Add the values to the SQL String
       $query .= "('".$val["id"]."', '".$val["name"]."', ".$val["measurementSequenceNumber"].", ".$val["temperature"].", ".$val["pressure"].", ".$val["humidity"].", ".$val["rssi"].", ".$val["txPower"].", ".$val["voltage"].", ".$val["movementCounter"].", ".$val["accelX"].", ".$val["accelY"].", ".$val["accelZ"].", CONVERT(datetimeoffset, '".$val["updateAt"]."', 127), '".$js_did."', ".$js_ble.", ".$js_loc["latitude"].", ".$js_loc["longitude"].")\r\n";
    }
	// write the SQL Statement to the file
    fwrite($fpd, $query."\r\n");
    fclose($fpd);

    // Upload to the database	
	$stmt = $db->prepare($query);
    $stmt->execute();
    unset($db); unset($stmt);

?> 
