<div class="container">

    <div class="span12 pushMe">

            <?php
            foreach ($path as $i => $value):
                ?>
                <div class="span3 actionItem jgPop pushMe" data-path="<?php echo $value['url']; ?>">
                    <h4><?php echo $value['title']; ?></h4>
                </div>
                <?php
            endforeach;
            ?>
   
    </div>


</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.actionItem').click(function(){
            var loc = $(this).attr('data-path');
            window.location.href = '<?php echo base_url() ?>index.php/user/' + loc;
        });
    });
</script>