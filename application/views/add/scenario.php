<div class="container pushMe">

    <div class="span8 offset1">
        <div class="span8 loginTop">
            <h3>Add a Scenario</h3>
        </div>
        <form method="post" action="savescenario">
        <div class="span8 pushMe">
            <label>Name</label>
            <input type="text" name="name" id="name" class="span8">
            
            <label>Description</label>
            <input type="text" name="description" id="description" class="span8">
            
            <label>Url</label>
            <input type="text" name="url" id="url" class="span8">

            <label>Year (Negative for BC)</label>
            <input type="text" name="year" id="year" class="span8">
            
            
            <label>Category</label>
            <select name="category" id="category">
                <?php
                    foreach($cat as $i=>$value):
                        ?>
                        <option value="<?php echo $value['PeriodID']; ?>"><?php echo $value['masterTitle']; ?></option>
                        <?php
                    endforeach;
                ?>
            </select><br/>
            <button class="btn btn-info">Save</button>
        </form>
        </div>
         
    </div>