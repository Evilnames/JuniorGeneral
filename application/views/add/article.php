<div class="container pushMe">

    <div class="span9 offset1">
        <div class="span9 loginTop">
            <h3>Article Maintenance</h3>
        </div>
    </div>

    <div class="span9 offset1">
        <div class="span9">
            <br/>
            <form action="<?php echo base_url(); ?>index.php/article/save/" method="post">

                <label>Title</label>
                <input class="span5" type="text" name="articletitle" id="articletitle" value="<?php if ($method == 'edit'): echo $article[0]['articletitle']; endif; ?>">
                <input type="hidden" id="type" name="type" value="<?php echo $method; ?>"/>

                <label>Author</label>
                <input class="span5" type="text" name="author" id="author" value="<?php if ($method == 'edit'): echo $article[0]['author']; endif; ?>">
                
                <label>Url (Must be Unique, after you add this you are not allowed to change it!)</label>
                <input class="span5" type="text" name="aUrl" id="aUrl" value="<?php if ($method == 'edit'): echo $article[0]['aUrl']; endif; ?>" <?php if ($method == 'edit'): echo 'readonly'; endif;?>>
                <span id="urlgood"></span>
                
                <label>Category</label>
                <select id="category" name="category" class="span5">
                    <?php
                    foreach ($articlecategorys as $i => $value):
                        ?>
                        <option value="<?php echo $value['artcatid']; ?>"
                        <?php
                            if ($method == 'edit'):
                                if ($value['artcatid'] == $article[0]['category']):
                                    echo 'selected';
                                endif;
                            endif;
                        ?>
                        >
                        <?php echo $value['ArticleCatTitle']; ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>

                <label>Article</label>
                <textarea id="articletext" name="articletext" style="width:100%; height:500px;"><?php if ($method == 'edit'): echo $articleText[0]['ArticleText']; endif; ?></textarea>

                <button id="save" class="btn btn-info">Save</button>
            </form>
        </div>
    </div>
</div>

<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>asset/tinymce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
        theme : "advanced",
        mode : "textareas"
});


    $(document).ready(function(){
        $("#aUrl").change(function(){
            var value = $(this).val();
            $.ajax({
                type:"post",
                data:{'url':value},
                url:"../checkURL",
                success : function(data){
                    testResult(data.result);
                }
            });
                
        }); 
        $("#aUrl").keydown(function(event){
            var ew = event.which;

            if(ew == 9 || ew == 8 || ew==46)
                return true;
            if(48 <= ew && ew <= 57)
                return true;
            if(65 <= ew && ew <= 90)
                return true;
            if(97 <= ew && ew <= 122)
                return true;

            return false;
        });
        
    });

    function testResult(r){
        if(r != 0){
            //Item exists
            //Item Doesn't Exists
            $("#save").attr("disabled", "disabled");
            $("#urlgood").html('<Font color=red>Error!</font>');
        } else {
            //Item Doesn't Exists
            $("#save").removeAttr('disabled');
            $("#urlgood").html('Good!');
        }
    };


</script>
