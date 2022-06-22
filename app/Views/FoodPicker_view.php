

 
<div class="food-genre">
    <label class="food-nav">
        <label class="" >Fruit</label>
    </label>
    <label class="food-nav">
        <label class="" >Veg</label>
    </label>
    <label class="food-nav">
        <label class="" >Mushrooms</label>
    </label>
</div>
            
<?php if (! empty($foods) && is_array($foods)): ?>
    <table class="table table-striped table-bordered mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Cost</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($foods as $f):?>
                <tr data-id="<?=$f['_id']?>" class="af" href='foodAdd/<?=$f['_id']?>'>
                    <td><label for=""><?=$f['foodName']?></label></td>
                    <td><label for=""><?=$f['cost']?></label></td>
                    <td><label for=""><?=$f['description']?></label></td>
                </tr>
            <?php endforeach ?>
            </tbody>
    </table>

<?php else: ?>
    <h2>You don't have a basket yet!</h3>
    
    <div id="result"></div>
    
<?php endif ?>

<a href="create">
    <button class="btn btn-primary mt-4">Add a food</button>
</a>