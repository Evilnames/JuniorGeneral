<div class="container">
    <div class="span12 masthead jgPop">
        <h1>Search Results</h1>
    </div>
    <div class="span12 pushMe">
    <table class="table table-bordered table-condensed table-striped">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Author</th>
            <th>Category</th>
            <th>Search Score</th>
        </tr>
    <?php
    
        foreach($data as $i=>$value):
            ?>
        <tr>
            <td><a href="<?php echo base_url(); ?>index.php/figure/view/<?php echo $value['info']['url'];?>"><?php echo $value['info']['Title'];?></a></td>
            <td><?php echo $value['info']['Description'];?></td>
            <td><a href="<?php echo base_url(); ?>index.php/figure/designer/<?php echo $value['info']['Designer']; ?>"><?php echo $value['info']['Designer'];?></a></td>
            <td><?php echo $value['info']['categoryTitle'];?></td>
            <td><?php echo $value['value'];?></td>
            
        </tr>
            <?php
        endforeach;
    ?>
    </div>
</div>