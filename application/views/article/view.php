<div class="container pushMe">
            <table class="table table-bordered table-striped table-condensed">
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Read it!</th>
        </tr>
    <?php
    foreach ($article as $a => $val):
    ?>
        <tr>
            <td><?php echo $val['articletitle']; ?></td>
            <td><?php echo $val['author']; ?></td>
            <td><?php echo $val['ArticleCatTitle']; ?></td>
            <td><a href="view/<?php echo $val['aUrl']; ?>" class="viewmore">View More...</a></td>
        </tr>
    <?php
    endforeach;
    ?>
    </table>


</div>