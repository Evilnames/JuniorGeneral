<div class="container">

    <div class="span12 masthead jgPop">
        <h1>Educational Resources</h1>
        <h3>Games for Everyone</h3>
    </div>

    <div class="span12">

        <hr/>
        <h2>Subcategories</h2>
        <ul class="nav nav-list">
            <?php
            foreach ($cat as $z => $zVal):
                echo '<li><a href="#' . $z . '">' . $zVal['masterTitle'] . '</a></li>';
            endforeach;
            ?>
        </ul>
        <hr/>
    </div>      

    <?php
    foreach ($cat as $i => $value):
    ?>
        <div class="span12">

            <a id="<?php echo $i; ?>"><h2><?php echo $value['masterTitle']; ?></h2></a>
            
            <table class="table table-bordered table-striped table-condensed">
                <tr><th>Title</th>
                    <th>Description</th>
                </tr>
                <?php
                    foreach($value['keys'] as $ii=>$val):
                       ?>
                <tr>
                    <td><A href="<?php echo $scenario[$val]['ScenarioURL'];  ?>" target="_blank"><?php echo $scenario[$val]['ScenarioName'];  ?></td>
                    <td><?php echo $scenario[$val]['ScenarioDescription'];  ?></td>
                    
                </tr>
                        <?php
                    endforeach;
                ?>
            </table>
        </div>
    
    <?php
    endforeach;
    ?>

</div>