<?php
include "../action/getAllBookings.php";
$results=  getAllBookingsRequests();

foreach($results as $result){
echo '
<tr>
    <td>' . $result['destination'] . '</td>
    <td>
        ' . $result['date']. ' 
    </td>
    <td>
    ' . $result['duration'] . ' 
    </td>
    <td>
    ' . $result['numberOfPeople'] . ' 
</td>
<td>
' . $result['budget'] . ' 
</td>
<td>
' . $result['typeName'] . ' 
</td>
<td>
' . $result['status_name'] . ' 
</td>
<td>
    <a style="color: #e74c3c;" class = "delete_icon" href="../action/delete_request.php?requestID=' . $result['requestID'] . '">
    <i class="fa-solid fa-trash-can"></i>
</a>
<a style="color: #e74c3c;"class = "edit_icon" href="../admin/edit_request.php?requestID=' . $result['requestID'] . '">
    <i class="fa-solid fa-pen-to-square"></i> 
</a> 
</td>

</tr>
';
}