<div class="span12 pushMe">

    <div class="span11 loginTop">
        <h3>Upload approval</h3>
    </div>
    <div class="span11">
        <table class="table table-bordered table-condensed table-striped">
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Uploader</th>
                <th>Options</th>
            </tr>
            <?php
            if (!$item):
                echo '<td colspan = 4>Nothing to Approve!</td>';

            else:
                foreach ($item as $i => $value):
                    ?>
                    <tr data-ref="<?php echo $value['UID']; ?>">
                    <td><?php echo $value['Title']; ?></td>
                    <td><?php echo $value['categoryTitle']; ?></td>
                    <td><?php echo $value['uploader']; ?></td>
                    <td><a class="btn btn-info" href="<?php echo base_url(); ?>index.php/figure/view/<?php echo $value['url']; ?>">View</a> 
                        <button class="btn btn-info" onClick="approve('<?php echo $value['UID']; ?>');">Approve</button> 
                        <button class="btn btn-info" onClick="voiditem('<?php echo $value['UID']; ?>');">Void</button></td>
                    </tr>
                            <?php
                    endforeach;
                endif;
                ?>

        </table>
    </div>
</div>

<script type="text/javascript">
    function approve(id){
        $.ajax({
           type:'post',
           url:'approvefigure',
           data:{'id':id},
           success : function(){
               $('[data-ref="'+ id +'"]').fadeOut();
           }
        });
    }
    function voiditem(id){
        $.ajax({
           type:'post',
           url:'vodifigure',
           data:{'id':id},
           success : function(){
               $('[data-ref="'+ id +'"]').fadeOut();
           }
        });
    }
</script>