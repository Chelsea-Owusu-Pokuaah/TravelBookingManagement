<?php
include "../action/getFlights.php";
$results=  getFlights();

foreach($results as $result){
echo '
<tr>
    <td>' . $result['departureDate'] . '</td>
    <td>
        ' . $result['departureTime']. ' 
    </td>
    <td>
    ' . $result['arrivalDate'] . ' 
    </td>
    <td>
    ' . $result['arrivalTime'] . ' 
</td>
<td>
' . $result['departureCity'] . ' 
</td>
<td>
' . $result['arrivalCity'] . ' 
</td>
<td>
' . $result['name'] . ' 
</td>
<td>
    <a style="color: #e74c3c;" class = "delete_icon" href="../action/deleteFlight.php?flightID=' . $result['flightID'] . '">
    <i class="fa-solid fa-trash-can"></i>
</a>
<a style="color: #e74c3c;"class = "edit_icon" href="../admin/editFlight.php?flightID=' . $result['flightID'] . '">
    <i class="fa-solid fa-pen-to-square"></i> 
</a> 
</td>

</tr>
';
}