<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<script language="JavaScript">
function isEmpty(theForm){
if(theForm.search.value === "")
{
    alert("No suburb is entered. ");
    return false;
}
    return true;
}
</script>
<?php include "common/head.html" ;?>

<body style="background-color: black">
<div id="main" class="container">

  <?php
  include "common/navigation.html";
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
        $suburb = $_POST["search"];
        $type = $_POST["type"];
        $query="SELECT * FROM LISTING l, PROPERTY p WHERE l.PROPERTY_ID = p.PROPERTY_ID and p.suburb = '".$suburb;
        
        if ($type != -1) {
          $query = $query."' and p.type_id = '".$type;
        }

        $query = $query."'";
        $stmt = oci_parse($conn, $query);
        oci_execute($stmt);
        $row= oci_fetch_all($stmt, $res);
        if ($row > 0 ){
            oci_execute($stmt);
            while(oci_fetch($stmt)){?>
                  <div id="Properties">
                      <div class="col-lg-3 col-md-4 col-sm-6" style="padding-top:30px;">
                          <P><?php echo oci_result($stmt, "NAME"); ?></P>
                          <p><?php echo oci_result($stmt, "STREET")." ".oci_result($stmt, "SUBURB"); ?></p>
                          <P><?php echo oci_result($stmt, "STATE"); ?></p>
                          <P><?php echo oci_result($stmt, "POSTCODE"); ?></P>
                          <div class="btn-group" role="group" >
                              <a href="property.php?Action=Update&id=<?php echo oci_result($stmt,"PROPERTY_ID"); ?>" class="btn btn-default">Edit</a>
                              <a href="property.php?Action=Delete&id=<?php echo oci_result($stmt,"PROPERTY_ID"); ?>"class="btn btn-default">Delete</a>
                          </div>
                      </div>
                  </div>
                  <?php
              }
        }
        else {
            echo "<p>No properties are found in database. </P>";
        }
      }
      ?>
    </div>
  
<?php include "common/footer.html" ; ?>
</div>
</body>

</html>