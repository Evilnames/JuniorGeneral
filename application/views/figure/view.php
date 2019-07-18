<div style="margin-top:25px;">

    <center>
    <h1><?php echo $iFig['Title']; ?></h1>
    <h4>By : <a href="../designer/<?php echo $iFig['Designer']; ?>"><?php echo $iFig['Designer']; ?></a></h4><br/>
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
                <p><a href="../designer/<?php echo $iFig['Designer']; ?>"><?php echo $iFig['Designer']; ?></a></p>
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
    <div class="span12" style="text-align:center">
        <a rel="license" target="blank" href="https://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="https://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons License</a>.
    </div>
</div>

