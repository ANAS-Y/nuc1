<?php require ('vcheader1.inc');
$accreditationID=$_SESSION['accreditationID'];
function input_check($data){ 
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return($data);
    }
    
    include_once("connection.php");
mysqli_select_db($db_link,"nucaccreditation") or die("Could not select database");
            
             /* Performing SQL query */
  $sql = "SELECT * FROM vcselfstudy_ssf WHERE accreditationID= '$accreditationID'";
             if (!mysqli_query($db_link,$sql)){
  die("Faild  to check the existance of Vc's self study form" . mysqli_error($db_link));    
}

if(mysqli_num_rows(mysqli_query($db_link,$sql)) > 0){
$result = mysqli_query($db_link,$sql);
$fetch=mysqli_fetch_assoc($result);
  
$objectives = $fetch["phillosophyObjectives"];
$utility = $fetch["utilityServices"];    
}
else{
  $objectives = '';
$utility = ''; 
}

  if($_SERVER["REQUEST_METHOD"]=="POST"){
       $Objectives =  input_check($_POST["philosophy"]);
       $uServices = input_check($_POST["utility"]);
       
mysqli_select_db($db_link,"nucaccreditation") or die("Could not select database");
            
             /* Performing SQL query */
  $sql = "SELECT * FROM vcselfstudy_ssf WHERE accreditationID= '$accreditationID'";
             if (!mysqli_query($db_link,$sql)){
  die("Faild  to check the existance of Vc's self study form" . mysqli_error($db_link));    
}

if(mysqli_num_rows(mysqli_query($db_link,$sql)) > 0){
   $sql= "UPDATE vcselfstudy_ssf SET `phillosophyObjectives` ='$Objectives', `utilityServices`='$uServices' WHERE `accreditationID`='$accreditationID'";
 if(!mysqli_query($db_link,$sql)){
     die("Faild  to update ownership and control" . mysqli_error($db_link));
      }
 $_SESSION["msg"]= "Updated Sucessfully";
/* Closing connection */
mysqli_close($db_link);
header('location:vcssf4.php');
}
else{
  
$sql = "INSERT INTO `vcselfstudy_ssf`(`accreditationID`, `ownershipControl`, `organisationAdministration`, `phillosophyObjectives`, `utilityServices`,
 `curriculumDesign`, `updatingCurricula`, `bookList`, `aquisitionPolicy`, `libraryservices`, `staffAccomodation`, `sportFacilities`, `healthFacilities`, 
 `recruitmentPolicy`, `staffDevelopment`, `firstName`, `surname`, `otherName`, `rank`, `dateSubmited`, `submissonStatus`) VALUES ('$accreditationID','',
 '','$Objectives','$uServices','','','','','','','','','','','',
 '','','','','')";

if (!mysqli_query($db_link,$sql)){
    die("Faild  to insert vc self study form " . mysqli_error($db_link));    
}
$_SESSION["msg"]= "Updated Sucessfully";
/* Closing connection */
mysqli_close($db_link);
header('location:vcssf4.php');
}
}

?>
<div class="container-fluid">
<!-- first div start here-->
<div class="col card" >
<!-- first div title-->
<div class="card-title " >
<h3 style="text-align: center;">SELF-STUDY FORM (NUC/SSF)</h3>
<h6 style="text-align: center;">SECTION:A Part IV-V (PHILOSOPhY,OBJECTIVES AND UTILITY SERVICES)</h6>
</div>

<!-- first div column-->
<div class="row">
<div class="col card form-category">
<div class="card-title ">
<h5 style="text-align: center;">PHILOSOPhY AND OBJECTIVES OF THE UNIVERSITY</h5>
</div>
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
<div class="form-row" >
 <label class="form-row"for="lawText">Briefly state the Philosophy and Objectives of the University</label>
    <div class="form-group" >
        <textarea class="form-control" id="philosophy" rows="5" cols="60" name="philosophy" required="required"><?php echo $objectives; ?></textarea>
  </div>
  </div>
  
  </div>
  
  



<!-- Second column start here-->
<div class="col second-category" >
<div class="col card form-category">
<div class="card-title ">
<h5 style="text-align: center;">UTILITY SERVICES</h5>
</div>
<div class="form-row" style="margin-left: 1%;">
 <label class="form-row"for="lawText">Describe the availability of utility services such as water, light, etc. provided by 
itself or Municipal utilities.</label>
    <div class="form-group">
        <textarea class="form-control" id="utility" required="required" rows="3" cols="58" name="utility"><?php echo $utility; ?></textarea>
  </div>
  </div>

</div>
 
 <div class="form-row">

 <div class="col">
<a class="btn btn-primary login-btn" href="vcssf2.php" style=" width: 95%; ">Pevious</a>
 </div>
  <div class="col">
<button type="submit" class="btn btn-primary login-btn" style="margin-left: 6%;width: 95%; ">Next</button>
 </div>
 
 </div>

 </form>
 </div>
 
<!-- first row closing tag-->
</div>
<!-- first div closing tag-->
</div>
<!-- Container closing tag-->
</div>
<?php require ('footer.inc');?>