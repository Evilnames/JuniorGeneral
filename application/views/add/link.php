<div class="container pushMe">

    <div class="span9 offset1">
        <div class="span9 loginTop">
            <h3>Link Maintenance</h3>
        </div>
    </div>

    <div class="span9 offset1">
        <div class="span9">
            <br/>
            <form action="<?php echo base_url(); ?>index.php/user/linkAdd/" method="post">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" > <br/>

                <label for="description">Description</label>
                <input type="text" id="description" name="description"> <br>

                <label for="Category">Category</label>
                <input type="text" id="Category" name="Category"> <br>

                <label for="Website">Website</label>
                <input type="text" id="Website" name="Website"> <br>

                <button id="save" class="btn btn-info">Save</button>
            </form>
        </div>
    </div>


</div>