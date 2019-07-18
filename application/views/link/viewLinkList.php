<div class="container">
    <div class="span12 masthead jgPop">
        <h1> Helpful Links </h1>
    </div>

    <?php 
        foreach($list as $i => $subCat){
            ?>
                <div class="span12">
                    <h2><?php echo $i;?></h2>
                    <hr/>
                    <table class="table table-bordered table-striped table-condensed">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Website</th>
                    </tr>

                    <?php 
                        foreach($subCat as $l => $link){
                            ?>
                            <tr>
                                <td><a href = "<?php echo $link['website'];?>" target="blank"><?php echo $link['title'];?></a></td>
                                <td><?php echo $link['Description'];?></td>
                                <td><a href = "<?php echo $link['website'];?>" target="blank"><?php echo $link['website'];?></a></td>
                            </tr>
                            <?php
                        }
                    ?>
                    </table>
                </div>
            <?php
        }

    ?>

</div>