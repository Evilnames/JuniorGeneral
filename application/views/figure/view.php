<div style="margin-top:50px;">
    <center>
        <img class="fig-image" src="<?php echo base_url() . $iFig['FileLocation']; ?>" alt="<?php echo $iFig['Title']; ?>">
    </center>
</div>
<div class="container">

    <div class="span12">
        <hr/>
        <div class="row-fluid">
            <div class="span3">
                <i>Title</i>
                <p><?php echo $iFig['Title']; ?></p>
            </div>

            <div class="span2">
                <i>Designer</i>
                <p><?php echo $iFig['Designer']; ?></p>
            </div> 

            <div class="span3">
                <i>Description</i>
                <p><?php echo $iFig['Description']; ?></p>
            </div>   

            <div class="span2">
                <i>Category</i>
                <p><?php echo $iFig['categoryTitle']; ?></p>
            </div> 

            <div class="span2">
                <i>Date Uploaded</i>
                <p><?php echo $iFig['DateUploaded']; ?></p>
            </div> 

        </div>

        <?php
        //admin panel
        if (DEFINED('JGLOGGEDIN') && DEFINED('ADMIN')):
            ?>
            <div class="span12 pushMe">
                <hr/>
                <h2>Admin Panel</h2>
                <a href="<?php echo base_url(); ?>index.php/user/editfigure/<?php echo $iFig['url']; ?>"  class="btn btn-info"><i class="jg_nineteen"></i>Edit</a>
            </div>

            <?php
        endif;
        ?>
    </div>

</div>