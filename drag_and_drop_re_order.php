//drag_and_drop_re_order.php
<html>  
 <head>  
  <title>jQuery Ajax Drag and Drop Reorder with PHP and MySQL</title>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<style>
.gallery{ width:100%; float:left;}
.gallery ul{ margin:0; padding:0; list-style-type:none;}
.gallery ul li{ padding:7px; border:2px solid #ccc; float:left; margin:10px 7px; background:none; width:auto; height:auto;}
.gallery img{ width:250px;}
</style>
 </head>  
 <body> 
<div class="container">
    <h2>jQuery Ajax Drag and Drop Reorder with PHP and MySQL</h2>
    <div>     
        <div class="gallery">
            <ul class="reorder-gallery">
            <?php        
include_once("db_connect.php");         
            $sql_query = "SELECT id, photoname FROM gallery ORDER BY display_order";
            $resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
            $data_records = array();
            while( $row = mysqli_fetch_assoc($resultset)) {             
            ?>
                <li id="<?php echo $row['id']; ?>" class="ui-sortable-handle"><a href="javascript:void(0);"><img src="img/<?php echo $row['photoname']; ?>" alt=""></a></li>
            <?php } ?>
            </ul>
        </div>
    </div><div id="test"></div>
</div>
<script>
$(document).ready(function(){   
    $("ul.reorder-gallery").sortable({      
        update: function( event, ui ) {
            updateOrder();
        }
    });  
});
function updateOrder() {    
    var item_order = new Array();
    $('ul.reorder-gallery li').each(function() {
        item_order.push($(this).attr("id"));
    }); 
    var order_string = 'order='+item_order;
    $.ajax({
        type: "GET",
        url: "order_update.php",
        data: order_string,
        cache: false,
        success: function(data){    
            $("#test").html(data);
        }
    });
}
</script> 
 </body>  
</html>  
