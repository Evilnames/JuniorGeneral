<Div class="container">

    <div class="span12 masthead jgPop">
        <h1>JuniorGeneral.org</h1>
        <h3>History Lessons They'll Never Forget</h3>
    </div>

    <!-- About Us Sections-->
    <div class="span12 pushMe">
        <Div class="span12 mainpusher">
            <h2>What Makes Juniorgeneral Great?</h2>
        </div>
        <div class="row-fluid">
            <div class="span4 aboutsec">

                <img class="jgPop" id="pset20" alt="">
                <p class="nonbooth2">Free and User Supported</p>
                <p>A free, user supported community of history enthusiasts taking on the challenge of drawing and documenting all of history.  Our community has designed <b>Everything</b> from the simple stone age caveman to Polish Soldiers sitting in Afganistan.</p>
            </div>

            <div class="span4 aboutsec">
                <img class="jgPop" id="pset2" alt="">
                <p class="nonbooth2">Common Scale</p>
                <p>Juniorgeneral's paper miniatures are designed using community defined scales and standards.  Our common scales mean that when you look at a figure you know there will always be an opponent to match!</p>
            </div>

            <div class="span4 aboutsec">
                <img class="jgPop" id="pset3" alt="">
                <p class="nonbooth2">Easy Wargames for Everyone</p>
                <p>Our wargames are built with students in mind.  They are easy, quick to play, and even easier to learn.  Plus our paper miniatures are built to complement them!</p>
            </div>

        </div>
    </div>
    <div class="span12">
        <Div class="span12 mainpusher">
            <hr/>
            <h2>What's New?</h2>
        </div>
        <div class="span12" style="text-align:center">
             <ul style="list-style:none">
                <li>Submit files <a href="https://form.jotform.com/91980734038160" target="_blank">Here</a>
            </ul>
        </div>
        <div class="row-fluid">
            <div class="span4 aboutsec">
                <h2>Paper Soldiers</h2>
                <ul>
                    <?php
                    foreach ($figure as $i => $value):
                        ?>
                        <li>
                            <a href="index.php/figure/view/<?php echo $value['url']; ?>"><?php echo $value['Title']; ?></a>
                        </li>
                        <?php
                    endforeach;
                    ?>
                    <li>
                        <a href="/index.php/figure/showMoreFigures/"><b>Show More Uploaded Files!</b></a>
                    </li>
                    <li>
                        <a target="_blank" href="https://form.jotform.com/91980734038160"><b>Submit a new file!</b></a>
                    </li>
                </ul>
            </div>
            <div class="span4 aboutsec">
                <h2>Scenarios</h2>
                <ul>
                    <?php
                    foreach ($scenario as $i => $value):
                        ?>
                        <li>
                            <a href="<?php echo $value['ScenarioURL']; ?>" target="_blank"><?php echo $value['ScenarioName']; ?></a>
                        </li>
                        <?php
                    endforeach;
                    ?>
                </ul>
            </div>
            <div class="span4 aboutsec">
                <h2>Articles</h2>
                <ul>
                    <?php
                    foreach ($articles as $a => $aval):
                        ?>
                        <li>
                            <a href="index.php/article/view/<?php echo $aval['aUrl']; ?>"><?php echo $aval['articletitle']; ?></a>
                        </li>
                        <?php
                    endforeach;
                    ?>
                </ul>
            </div>
        </div>


        <br>
        <br>
        <br>
        <div class="span12" style="text-align:center">
            <a href="index.php/landing/privacy/">Privacy Policy</a>
        </div>
    </div>
    <Script type="text/javascript">
        $('document').ready(function(){
            $("#pset20").attr('src', "/asset/juniorgeneral/img/art/pSet20.png");
            $("#pset2").attr('src', "/asset/juniorgeneral/img/art/pSet2.png");
            $("#pset3").attr('src', "/asset/juniorgeneral/img/art/pSet3.png");
        });
    </script>
