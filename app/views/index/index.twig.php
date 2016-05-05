<h1>Index Page</h1>
<p>Mt name is <?= $name ?> <? echo $name; ?></p>

<ul>
    
        
    

</ul>
    <?php foreach ($users as $developer) { ?>
    <div class="workers">
        <p>
            <strong>1</strong>: <?= $developer['name'] ?> </br>
            <strong>1</strong>: <?= $developer['jobs'] ?> </br>
            <strong>1</strong>:
        <ul>
           <?php foreach ($developer['skills'] as $skill) { ?>
            <li>
                <?= $skill ?>
            </li>
            <?php } ?>
        </ul>

        </p>
    </div>
    <?php } ?>



