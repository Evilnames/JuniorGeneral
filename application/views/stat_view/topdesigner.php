<div class="container">
    <div class="span12 masthead jgPop">
        <h1>Top Paper Miniature Contributors</h1><br/>
        <h4>100 top designers out of <?php echo number_format($total,0);?></h4>
    </div>
  <br/><br/><br/>

  <div class="span12">
        <h3>Designer Stats</h3>
        <table class="table table-bordered table-striped table-condensed" style="margin-top:20px;">
            <tr>
                <th></th>
                <th>Designer</th>
                <th>Figures Contributed</th>
            </tr>
            <?php 
                foreach($designers as $i=>$design){
            ?>
                <tr>
                    <td><?php echo number_format($i, 0) + 1;?></td>
                    <td><a href="<?php echo base_url(); ?>index.php/figure/designer/<?php echo $design['Designer']; ?>"><?php echo $design['Designer'];?></a></td>
                    <td><?php echo number_format($design['Submitted'], 0);?></td>
                </tr>
            <?php
                }
            ?>
        </table>
    </div>
</div>