<div class="container">
    <div class="span12 masthead jgPop">
        <h1><?php echo str_replace("%20", " ", $designer); ?> </h1><br/>
        <h4>Designer Showcase</h4>
    </div>
  <br/><br/><br/>

    <div class="span12">
        <h3>Designer Stats</h3>
        <table class="table table-bordered table-striped table-condensed" style="margin-top:20px;">
            <tr>
                <th>Statistic</th>
                <th>Amount</th>
            </tr>
            <tr>
                <td>Number of Figures Contributed</td>
                <td><?php echo number_format($totalFigures, 0);?></td>
            </tr>
        </table>
    </div>

<?php 
    foreach($records as $i => $record){
        foreach($record['SubCategory'] as $s => $subCat){
            ?>
                <div class="span12">
                    <h3><a href="../figureList/<?php echo $record['masterURL'];?>"><?php echo $i;?></a> > <?php echo $s;?></h3>
                    <table class="table table-bordered table-striped table-condensed" style="margin-top:20px;">

                        <tr><th>Title</th>
                            <th>Description</th>
                            <th>Date Uploaded</th>
                        </tr>
                        <?php
                        foreach ($subCat as $x => $figure):
                            ?>
                            <tr>
                                <td><a href="../view/<?php echo $figure['url']; ?>"><?php echo $figure['Title']; ?></a></td>
                                <td><?php echo $figure['Description']; ?> &nbsp;</td>
                                <td><?php 
                                    echo ($figure['DateUploaded'] != "0000-00-00 00:00:00") ? date("m/d/Y", strtotime($figure['DateUploaded'])) : 'Before Time' ; 
                                ?></td>                          
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </table>
            </div>

            <?php
        }
    }

?>