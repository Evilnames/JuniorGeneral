<div class="container">
    <div class="span12 masthead jgPop">
        <h1><?php echo $lookupCount ?> latest figures</h1>
    </div>
    <div class="span12">
        <table class="table table-condensed table-striped">
            <tr>
                <th>Figure Name</th>
                <th>Description</th>
                <th>Designer</th>
                <th>Upload Date</th>
            </tr>
            <?php
            foreach ($figure as $i => $value):
          
                ?>
                <tr>
                    <td><a href="/index.php/figure/view/<?php echo $value['url']; ?>"><?php echo $value['Title']; ?></a></td>
                    <td><?php echo $value['Description']; ?></td>
                    <td><?php echo $value['Designer']; ?></td>
                    <td><?php echo date("m/d/Y", strtotime($value['DateUploaded'])); ?></td>
                </tr>
                <?php
            endforeach;
            ?>
        </table>
    </div>        

</div>
