<HTML>
<HEAD>
 <TITLE> Hello World</TITLE>
</HEAD>   
<BODY>
<?php
  include('../../Sources/yocto_api.php');
  include('../../Sources/yocto_tilt.php');
  include('../../Sources/yocto_compass.php');
  include('../../Sources/yocto_gyro.php');
  include('../../Sources/yocto_accelerometer.php');
  
  // Use explicit error handling rather than exceptions
  yDisableExceptions();

  // Setup the API to use the VirtualHub on local machine
  if(yRegisterHub('http://127.0.0.1:4444/',$errmsg) != YAPI_SUCCESS) {
      die("Cannot contact VirtualHub on 127.0.0.1");
  }

  @$serial = $_GET['serial'];
  if ($serial != '') {
      // Check if a specified module is available online
      $anytilt = yFindTilt("$serial.tilt1");
      if (!$anytilt->isOnline()) { 
          die("Module not connected (check serial and USB cable)");
      }
  } else {
      // or use any connected module suitable for the demo
      $anytilt = yFirstTilt();
      if(is_null($anytilt)) {
          die("No module connected (check USB cable)");
      } else {
          $serial = $anytilt->module()->get_serialnumber();
      }
  }
  Print("Module to use: <input name='serial' value='$serial'><br>");

  // Get all sensor on the device matching the serial
  $tilt1         = yFindTilt("$serial.tilt1");
  $tilt2         = yFindTilt("$serial.tilt2");
  $compass       = yFindCompass("$serial.compass");
  $gyro          = yFindGyro("$serial.gyro");
  $accelerometer = yFindAccelerometer ("$serial.accelerometer");
   
  $tilt1value         =  $tilt1->get_currentValue();
  $tilt2value         =  $tilt2 ->get_currentValue(); 
  $compassvalue       = $compass->get_currentValue();  
  $gyrovalue          = $gyro->get_currentValue();  
  $accelerometervalue =  $accelerometer->get_currentValue();
 
  Print("tilt1: $tilt1value &deg;<br>");
  Print("tilt2: $tilt2value &deg;<br>");
  Print("compass: $compassvalue &deg;<br>");
  Print("gyro: $gyrovalue &deg;/s<br>");
  Print("Accelerometer: $accelerometervalue  g<br>");
  
  
  // trigger auto-refresh after one second
  Print("<script language='javascript1.5' type='text/JavaScript'>\n");
  Print("setTimeout('window.location.reload()',500);");
  Print("</script>\n");
?>  
</BODY>
</HTML> 
