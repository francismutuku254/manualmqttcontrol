<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the control value (either "ON" or "OFF")
    $controlValue = $_POST['control'];

    // Define the MQTT topic and broker
    $broker = "localhost";
    $topic = "test/topic";
    
    // Full path to mosquitto_pub
    $mosquittoPubPath = '"C:\Program Files\mosquitto\mosquitto_pub.exe"'; // Adjust the path if necessary
    
    // Construct the command to publish the message using mosquitto_pub
    $command = $mosquittoPubPath . ' -h ' . $broker . ' -t ' . $topic . ' -m ' . $controlValue;

    // Execute the command and capture the output and return status
    $output = [];
    $return_var = 0;
    exec($command . ' 2>&1', $output, $return_var);

    // Check for errors
    if ($return_var !== 0) {
        echo "Error executing command: " . implode("\n", $output);
    } else {
        echo "Pump is turned " . $controlValue;
    }
}
?>
