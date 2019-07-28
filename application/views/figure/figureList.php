

<div class="container">
    <div class="span12 masthead jgPop">
        <h1><?php echo $masterData[0]['masterTitle']; ?> </h1>
        <h3>Paper Miniatures</h3>
    </div>
    <div class="span12">

        <hr/>
        <h2>Subcategories</h2>
        <ul style="list-style:none">
            <?php
            foreach ($items as $z => $zVal):
                echo '<li><a href="#' . $z . '">' . $zVal[0]['categoryTitle'] . '</a></li>';
            endforeach;
            ?>
        </ul>
    </div>        
    <?php
    foreach ($items as $i => $value):
        ?>
        <div class="span12">

            <a id="<?php echo $i; ?>"><h2><?php echo $value[0]['categoryTitle']; ?></h2></a>
            <hr/>

            <table class="table table-bordered table-striped table-condensed">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Designer</th>
                    <th>Date Uploaded</th>
                </tr>
                <?php
                foreach ($value['figureList'] as $x => $xVal):
                    //Find the position with the correct UID
                    //$u = array_search($x, $figList);

                    
                    ?>
                
                <tr>
                    
                        <td><a href="../view/<?php echo $xVal['url']; ?>"><?php echo $xVal['Title']; ?></a></td>
                        <td><?php echo $xVal['Description']; ?> &nbsp;</td>
                        <td><a href="../designer/<?php echo $xVal['Designer']; ?>"><?php echo $xVal['Designer']; ?></a></td>  
                        <td><?php 
                            echo ($xVal['DateUploaded'] != "0000-00-00 00:00:00") ? date("m/d/Y", strtotime($xVal['DateUploaded'])) : 'Before Time' ; 
                        ?></td>                          
                    </tr>
                    <?php
                endforeach;
                ?>
            </table>


            <?php
            echo '            </div>';
        endforeach;
        ?>

    </div>
