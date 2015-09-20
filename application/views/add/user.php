<div class="container pushMe">

    <div class="span8 offset1">
        <div class="span8 loginTop">
            <h3>Add a User</h3>
        </div>
        
        <div class="span8">
            <form method="post" action="saveuser">
                <label>Username</label>
                <input type="text" id="username" name="username">
                <label>Password</label>
                <input type="text" id="password" name="password">
                <label>Usertype</label>
                <select id="userper" name="userper">
                    <option value="1">User</option>
                    <option value="2">Moderator</option>
                    <option value="3">Administrator</option>
                </select><br/>
                
                <button class="btn btn-info">Add</button>
                <a href ="<?php echo base_url(); ?>" class="btn btn-danger">Cancel</a>
            </form>
            
        </div>
        
    </div>
</div>