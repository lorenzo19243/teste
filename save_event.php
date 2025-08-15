<?php                
require 'config/conexao.php'; 
$event_name = $_POST['event_name'];
$event_start_date = date("Y-m-d", strtotime($_POST['event_start_date'])); 
			
$insert_query = "insert into `folgas`(`tecnico`,`data`) values ('".$event_name."','".$event_start_date."')";             
if(mysqli_query($conn, $insert_query))
{
	$data = array(
                'status' => true,
                'msg' => 'Event added successfully!'
            );
}
else
{
	$data = array(
                'status' => false,
                'msg' => 'Sorry, Event not added.'				
            );
}
echo json_encode($data);	
?>
