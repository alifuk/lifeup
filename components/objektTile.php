
<div class="panel panel-default tile" style='background-image: url(<?php echo $image; ?>); background-position: center;   background-size: 322px;'>
    <div class="panel-body" >
        <a href='<?php echo $link; ?>' target="_blank"><span class="glyphicon glyphicon glyphicon-link" aria-hidden="true" ></span> <?php echo $name; ?></a>
        
        <div class="bottom" style="margin: 5px;"><?php echo $tagHTML; ?>
            <span class="glyphicon glyphicon-trash delete" aria-hidden="true" onclick="deleteItem('<?php echo $Idecko; ?>');" style="left: auto; right: 0;"></span>
            
        </div>


    </div>

</div>
