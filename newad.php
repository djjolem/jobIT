<!DOCTYPE html>
<?php 
  include 'dbConnect.php';

  $model = new DBConnection;
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Short List </title>

  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/datepicker.css">
</head>

<body>
<div class="container center-block">

  <?php include 'menu.php'; ?>
	
	<div class="container center-block row">
	  <div class="col-xs-2">&nbsp;</div>

  	<div class="col-xs-8"> 
  		<form class="form-horizontal" role="form" id="new_ad" name="new_ad" action="savead.php" method="post">
  			<h2> New ad </h2> <?php echo $_SESSION['user_name']; ?>
        <input name="user" value="0" />
        <?php if (isset($_SESSION['user_id'])){ ?> 
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
        <?php } else {?>
        <input type="hidden" name="user_id" value="0" />
        <?php } ?>
  			<div> &nbsp; </div>

				<label>Company</label>
				<select id="company" name="company" class="form-control">
          <option value="0"> Choose company </option>
					<?php 
					$companies = $model->getCompanies();
					for ($i=0; $i<sizeof($companies); $i++){
					?>
					<option value="<?php echo ($i+1); ?>"> Company <?php echo $companies[$i]; ?></option>
					<?php } ?>
				</select>
				<div> &nbsp; </div>

				<label> Title </label>
  			<input type="text" class="form-control" placeholder="Ad Title" id="ad_title" name="ad_title">
  			<div> &nbsp; </div>

				<label> Short text </label>
  			<textarea class="form-control" rows="3" placeholder="Short description" id="ad_description" name="ad_description">
  			</textarea>
  			<div> &nbsp; </div>

				<label> Ad text </label>
  			<textarea class="form-control" rows="10" placeholder="Text of ad" id="ad_text" name="ad_text"></textarea>
  			<div> &nbsp; </div>


  			<!--- <div class="form-group">-->
  			<label> Tags </label><br>
  			<?php 
  			$tags = $model->getTags();
  			for($i=0; $i<sizeof($tags); $i++){
  			?>
				<label class="checkbox-inline">
					<input type="checkbox" id="cb_tag" name="cb_tag[]" value="<?php echo $tags[$i]['tag_id']; ?>"> 
						<?php echo $tags[$i]['tname']; ?>
					</input>
				</label>
				<?php } ?>

  			<!-- </div> _=-->
  			<div> &nbsp; </div>
				<label class="control-lablel"> Deadline </label>
        <br>
        <div class="well">
          <div class="form-group">
            <div class="input-group date">
              <input class="form-control" type="text" data-format="yyyy-MM-dd" id="deadline" name="deadline"></input>
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
              </span>
            </div>
          </div>
        </div>
				<div> &nbsp; </div>

        <div>
          <label> Location </label><br>
            Bilo gde
        </div>
        <div> &nbsp; </div>

				<button type="submit" class="btn btn-primary"> Submit </button>
  		</form>
  	</div>
  		
  	</div>

		<div class="col-xs-2">&nbsp;</div>
	</div>

</div>


<script src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>

<script type="text/javascript">
  $(document).ready(function($){
    $('#deadline').datepicker(); 
  });
</script>

</body>
</html>

