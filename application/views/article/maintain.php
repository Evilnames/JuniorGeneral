<div class="container pushMe">

    <div class="span12 well">
        <h2> Article Maintenance</h2>
    </div>
    <div class="span12">
        <p>This is a list of all articles in the system.  If they are not yet approved or edited they are on the top of the page.</p>
    </div>
    <div class="span12">
        Articles List
        <table class="table table-stripped">
            <tr>
                <th>Article Title</th>
                <th>Author</th>
                <th>Edit</th>
                <th>Awaiting Approval?</th>
            </tr>
            <?php
            foreach ($articles as $a => $val):
                ?>
                <tr>
                    <td><?php echo $val['articletitle']; ?></td>
                    <td><?php echo $val['author']; ?></td>
                    <td>
                        <?php
                        if ($this->session->userdata('UserLevel') >= 2) {
                            ?>
                            <a href="../article/modify/<?php echo $val['aUrl']; ?>/" class="btn btn-info">Edit</a></td>
                        <?php
                    }
                    ?>
                    <td>
                        <?php
                        if ($val['dateapproved'] == '0000-00-00' && $this->session->userdata('UserLevel') >= 2) {
                            ?>
                            <button data-url="<?php echo $val['aUrl']; ?>" onClick="approve('<?php echo $val['aUrl']; ?>');" class="btn btn-info">Approve</button>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </table>

    </div>


    <script>
        function approve(url){
            $.ajax({
                type:'post',
                data:{url:url},
                url:'../article/approve/',
                success:function(){
                    $('button[data-url="'+ url +'"]').fadeOut('fast');
                }
            });
        }
    </script>

</div>