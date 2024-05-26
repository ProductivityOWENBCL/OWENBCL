<?php
// MySQL server configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "experpsy";

if (!isset($_GET['action'])){
    echo "Hello there";
    die();    
}

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function run_sql($sql){
    global $conn;
    $resultarr = array();
    $result = $conn->query($sql);
    if($result===TRUE){
        return TRUE;
    }
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $resultarr[] = $row;
        }
    }
    return $resultarr;
}

function get_psychologist(){
    $result = run_sql("select * from Psychologist;");
    echo "[";
    for ($i = 0; $i < count($result); $i++) {
        echo "{";
        echo "\"user_id\":\"" . $result[$i]["user_id"] . "\",";
        echo "\"name\":\"" . $result[$i]["name"] . "\",";
        echo "\"description\":\"" . $result[$i]["description"] . "\",";
        echo "\"photo\":\"" . $result[$i]["photo"] . "\"";
        echo "}";
        if ($i<count($result)-1){
            echo ",";
        }
    }
    echo "]";
    header("Content-Type: application/json");
}

function get_active_chat($user_id){
    $result = run_sql("select distinct 
        if(msg_from = '$user_id',msg_to,msg_from) participant
        from messages where 
        msg_from = '$user_id' or msg_to = '$user_id' 
        order by msg_date desc");
    echo "[";
    for ($i = 0; $i < count($result); $i++) {
        $participant = $result[$i]["participant"];
        echo '"'.$participant.'"';
        if ($i<count($result)-1){
            echo ",";
        }        
    }
    echo "]";
}

function get_chat_messages($user_id, $participant){
    $result = run_sql("select * from messages where 
        (msg_from = '" . $user_id . "' and msg_to = '" . $participant . "') or
        (msg_from = '" . $participant . "' and msg_to = '" . $user_id . "')");
    echo "[";
    for ($i = 0; $i < count($result); $i++) {
        $msg_date = $result[$i]["msg_date"];
        $msg_from = $result[$i]["msg_from"];
        $message = $result[$i]["message"];
        echo "{
            \"msg_date\": \"$msg_date\", 
            \"msg_from\": \"$msg_from\", 
            \"message\": \"$message\" 
        }"; 
        if ($i<count($result)-1){
            echo ",";
        }
    }
    echo "]";
    header("Content-Type: application/json");
}

function send_message($user_id, $recipient, $message){
    $result = run_sql("INSERT INTO messages (msg_date,msg_from,msg_to,message) VALUES (NOW(),'$user_id','$recipient','$message')");
    if ($result === TRUE) {
        echo '{"result":"ok"}';
    }
}

// Get params
$action = $_GET['action'];
$sql = null;
switch($action){
    case "get_psychologist":
        get_psychologist();
        break;
    case "get_activechat":
        if (isset($_GET['user'])){
            get_active_chat($_GET['user']);
        }
        break;
    case "get_messages":
        if (isset($_GET['user']) && isset($_GET['participant'])){
            get_chat_messages($_GET['user'],$_GET['participant']);
        }
    case "send_message":
        if(
            $_SERVER['REQUEST_METHOD']==="POST" && 
            isset($_GET['user']) &&
            isset($_GET['recipient']) && 
            isset($_POST['message'])
        ) {
            send_message($_GET['user'], $_GET['recipient'], $_POST['message']);
        }
    default:
        break;
}
header("Content-Type: application/json");

// Perform CRUD actions

// Create a new record
// $sql = "INSERT INTO bookmark (id, jsonContent, userid) VALUES (27, 'Test value by PHP', 56453434)";
// if ($conn->query($sql) === TRUE) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// // Update a record
// $sql = "UPDATE your_table SET column1 = 'new_value' WHERE id = 1";
// if ($conn->query($sql) === TRUE) {
//     echo "Record updated successfully";
// } else {
//     echo "Error updating record: " . $conn->error;
// }

// // Delete a record
// $sql = "DELETE FROM your_table WHERE id = 1";
// if ($conn->query($sql) === TRUE) {
//     echo "Record deleted successfully";
// } else {
//     echo "Error deleting record: " . $conn->error;
// }

// Close the connection
$conn->close();
?>