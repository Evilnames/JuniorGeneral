<div class="container pushMe">

    <div class="span8 offset1">
        <div class="span8 loginTop">
            <h3>Add a figure</h3>
        </div>

        <div class="span8">

            <form method="post" action="/index.php/user/savefile/" enctype="multipart/form-data">
                <label>Page Title</label>
                <input required class="span5"  type="text" id="pTitle" name="pTitle" <?php
                        if ($edit): echo 'value="' . $figure[0]['Title'] . '"';
                        endif;
                        ?>>

                <label>URL</label>
                <?php
                if ($edit):
                    //You cannot edit a url
                    echo $figure[0]['url'];
                    echo '<input type="hidden" name="edit" id="edit" value="' . $figure[0]['url'] . '">';
                else:
                    ?>
                    <input required class="span5" type="text" id="url" name="url">
                    <span id="urlgood"></span>
                    <span class="help-block">Can contain no spaces, or special characters.  Must be unique, and once put in the system it should not be changed (For SEO Purposes)</span>      
                <?php
                endif;
                ?>

                <label>Designer</label>
                <input required class="span5" type="text" id="pDesigner" name="pDesigner"  <?php
                if ($edit): echo 'value="' . $figure[0]['Designer'] . '"';
                endif;
                ?>>

                <label>Description</label>
                <input class="span5" type="text" id="Description" name="Description"  <?php
                       if ($edit): echo 'value="' . $figure[0]['Description'] . '"';
                       endif;
                ?>>

                <label>Category</label>
                <select class="span5" id="category" name="category">
                    <?php
                    foreach ($cat as $i => $value) {

                        if ($edit && $value['Subcatagory'] == $figure[0]['SubPeriod']):
                            echo '<option selected="selected" value="' . $value['Subcatagory'] . '">' . $value['masterTitle'] . ' - ' . $value['categoryTitle'] . '</option>';

                        else:
                            echo '<option value="' . $value['Subcatagory'] . '">' . $value['masterTitle'] . ' - ' . $value['categoryTitle'] . '</option>';

                        endif;
                    }
                    ?>
                </select>

                <label>File Selection</label>
                <input class="span5" type="file" name="userfile" id="userfile">
                <?php
                if ($edit):
                    echo '<span class="help-block">Leave Blank if editting a file and you do not want to add another file in its place.';
                endif;
                ?>
                <br/>
                <button class="btn btn-info" id="save">Save</button>
                <a href ="<?php echo base_url(); ?>" class="btn btn-danger">Cancel</a>
            </form>

        </div>

    </div>


</div>

<script type="text/javascript">

    function testURL(value){
        $.ajax({
            type:"post",
            data:{'url':value},
            url:"urlcheck",
            success : function(data){
                testResult(data.result);
            }
        });
    }

    $(document).ready(function(){
        $("#url").blur(function(){
            var value = $(this).val();
            testURL(value);
        }); 

        //Why?  The URL stuff is more of an internal function, 
        //but the user can change it if they want something different
        $("#pTitle").blur(function(){
            //Check to see if this is in an edit or add state
            if(!$("#edit").length){
                var title = $(this).val();
                //Strip out any bad characters/spaces from the title
                title = title.replace(/[^a-z0-9]/gi, '');

                //Replace any missing items here
                if($("#url").val().length == 0){
                    $("#url").val(title);
                    testURL(title);
                }
            }
        });


        $("#url").keydown(function(event){
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
        if(r == 1){
            //Item exists
            //Item Doesn't Exists
            $("#save").attr("disabled", "disabled");
            $("#urlgood").html('<Font color=red>Error!  This URL has been used already</font>');
        } else {
            //Item Doesn't Exists
            $("#save").removeAttr('disabled');
            $("#urlgood").html('Good! This url has not been used before');
        }
    };

</script>