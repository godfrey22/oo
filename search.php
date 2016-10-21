  <?php
  include('controller/SearchController.php');
  include('model/database.class.php');
  include('model/property.class.php');
  $database = new DB();
  $property = new Property($database->get_conn());
  $search = new SearchController($database->get_conn());
  $type = $search->getType();
  $feature = $search->getFeature();
  $where=array();
  ?>
<div id= "search" class="container">
      <form class="form-horizontal" OnSubmit="return isEmpty(this)" action="search.php" method="POST">
        <div class="form-group  col-lg-6 col-md-12">
          <input class="form-control" placeholder="Search by suburb" name="search">
        </div>
        <div id="type" class="col-lg-2 col-md-4" >
          <p>Property Type:</p>
          <select class="selectpicker" name="type">
            <option value="-1">All</option>
            <?php 
              foreach ($type as $key => $value) {?>
                <option value="<?php echo $key ?>"><?php echo $value ?></option>
              <?php
              }
            ?>
          </select>
        </div>
        <div id="feature">
          <?php 
            foreach ($feature as $key => $value) {?>
              <input type="checkbox" name="feature" value="<?php echo $key?>" /><?php echo $value?> <br />
              
            <?php
            }?>


        </div>
          <div id="search_btn" class="col-lg-2 col-md-4" >
                <button type="submit" class="btn btn-primary">Search</button>
          </div>
      </form>
</div>

    <hr style="border-top: dotted 1px;">
    <div id="result" class="container">
      <?php
      if (isset($_POST["search"])){
        $where['SUBURB'] = $_POST["search"];
        if($_POST["type"] != -1){
          $where['TYPE_ID'] = $_POST["type"];    
        }
        var_dump($where);

        print_r($property->find([$where]));
            
        }
        else {
            echo "<p>No properties are found in database. </P>";
        }
      
      ?>
    </div>