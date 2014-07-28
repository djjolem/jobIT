<!DOCTYPE html>
<?php
	session_start(); 
  include 'dbConnect.php';

  $model = new DBConnection;
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Short List</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>

<body>
<div class="container center-block">

  <?php include 'menu.php'; ?>

  <div class="container center-block row">
  	<div class="col-xs-2">&nbsp;</div>

  	<div class="col-xs-8"> <h1>Settings</h1> </div>

  	<div class="col-xs-2">&nbsp;</div>
  </div>

  <div class="container center-block row">
    &nbsp;
  </div>

  <div class="container center-block row">
    <div class="col-xs-2"></div>

    <div class="col-xs-8">
      <table class="table table-hover">
      <thead>
        <tr>
          <th> Left </th>
          <th> Right </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td> Loging </td>
          <td> ... </td>
        </tr>
        <tr>
          <td> Name </td>
          <td> ... </td>
        </tr>
        <tr>
          <td> Location </td>
          <td> Belgrad </td>
        </tr>
        <tr>
          <td> Company(ies) </td>
          <td> ... // if exist </td>
        </tr>
        <tr>
          <td> Notifications </td>
          <td> check box </td>
        </tr>
        <tr>
          <td> Language </td>
          <td> English / Serbian </td>
        </tr>
        <tr>
          <td> My skills </td>
          <td> Java, PHP, HTML </td>
        </tr>
        <tr>
          <td> Change password </td>
          <td> Button </td>
        </tr>
        <tr> 
          <td> &nbsp; </td>
          <td> &nbsp; </td>
        </tr>
        <tr>
          <td> Linked accounts </td>
          <td> LinkedIn, Skill Pages, Twitter, ... </td>
        </tr>
        <tr>
          <td> Biography - CV - resume </td>
          <td> Edit you resume </td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td> &nbsp; </td>
          <td> &nbsp; </td>
        </tr>
      </tfoot>
      </table>
    </div>

    <div class="col-xs-2"></div>
  </div>
</div>

<script src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>

</body>
</html>