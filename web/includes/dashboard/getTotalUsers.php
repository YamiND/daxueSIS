<?php

include_once '../dbConnect.php';
include_once '../functions.php';

session_start(); // Our custom secure way of starting a PHP session.

if ((login_check($mysqli) == true) && (isAdmin($mysqli)))
{
	getTotalUsers($mysqli);
}
else
{
   	http_response_code(403);
}

function getTotalUsers($mysqli)
{
	if ($stmt = $mysqli->prepare("SELECT userID FROM users"))
	{
      	if ($stmt->execute())
      	{
      		$stmt->store_result();

     		echo $stmt->num_rows; 
      	}
      	else
      	{
      		?> 
				<script type="text/javascript">
				new PNotify({
                              title: 'Error Fetching Data!',
                              text: 'Could not execute user query.',
                              type: 'error',
                              styling: 'bootstrap3'
                          });
 			</script>
		<?php
      	}
    }
    else
    {
    	?> 
				<script type="text/javascript">
				new PNotify({
                              title: 'Error Fetching Data!',
                              text: 'Could not prepare fetch.',
                              type: 'error',
                              styling: 'bootstrap3'
                          });
 			</script>
		<?php
    }
}

?>