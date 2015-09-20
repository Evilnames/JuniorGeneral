<div class="container">

    <div id="titleholder" class="span12 well pushMe">
        <h1><?php echo $article[0]['articletitle']; ?></h1>
    </div>
    <div id="detailsholder" class="span12 row-fluid">
        <div class="span5">Author :<?php echo $article[0]['author']; ?></div> 
        <div class="span5">Category :<?php echo $article[0]['ArticleCatTitle']; ?></div>

    </div>
    <div class="span12"><hr/></div>
    <div id="articleholder" class="span12">

        <?php echo $articleText[0]['ArticleText']; ?>
    </div>


</Div>
