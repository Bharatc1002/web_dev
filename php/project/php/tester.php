<?php



$output .= '<a href="" >
<div class="content" class="'.$row['unique_id'].'" style="position: relative;">
<img src="php/images/'. $row['img'] .'" alt="">
<div class="details">
    <span>'. $row['fname']. " " . $row['lname'] .'</span>
    <p>'. $typ .'</p>
</div>
'.$style .'
</div>

<div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>

</a>'; 



?>