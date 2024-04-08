<?php
    require_once('../Model/init.php');

    $con = new config();
    $con->openConnection();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <?php include '../Controller/designs.php'; ?>
    <link rel="stylesheet" href="../mytest.css" />

  </head>
  <body>
    <input type="hidden" id="role" value="admin" />
    <div class="sidebar">
      <i class="fa-solid fa-xmark close-sidebar"></i>
      <div class="row p-3 mt-3 pb-1">
        <div class="col-3">
          <img src="../assets/images/logo1.png" />
        </div>
        <div class="col-9">
          <span>Calltek Center Inventory System</span>
          <p>Version 3.0</p>
        </div>
      </div>

      <div class="dasboard-text">
        <span><i class="fa-solid fa-circle-user"></i>&nbsp;CTC Cher</span><br />
        <small>Data Miner/HR</small>
      </div>
      <div class="menu">
        <div class="item">
          <a class="sub-btn" href="dashboard.php" id="dashboardMenu">Dashboard</a>
        </div>
        <div class="item">
          <a class="sub-btn" href="itemlists.php" id="itemLists">Item Lists</a>
        </div>
        <div class="item" id="adminTools">
          <a class="sub-btn"
            >Admin Tools <i class="fa-solid fa-caret-right dropdown-icon"></i
          ></a>
          <div class="sub-menu">
            <a  class="sub-item">Manage User </a>
            <a  class="sub-item" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategory">Manage Category</a>
          </div>
        </div>
        <div class="item" id="encoder">
          <a class="sub-btn"
            >Maintenance <i class="fa-solid fa-caret-right dropdown-icon"></i
          ></a>
          <div class="sub-menu">
            <a class="sub-item">Add New Item</a>
            <a class="sub-item">View Partial Items</a>
          </div>
        </div>
        <div class="item" id="pcTech">
          <a class="sub-btn"
            >Record<i class="fa-solid fa-caret-right dropdown-icon"></i
          ></a>
          <div class="sub-menu">
            <a class="sub-item">Record Items</a>
            <a class="sub-item">Assign/Transfer</a>
          </div>
        </div>
        <div class="item">
          <a class="sub-btn"
            >Reports <i class="fa-solid fa-caret-right dropdown-icon"></i
          ></a>
          <div class="sub-menu">
            <a  class="sub-item" id="reportAnnually">Annually </a>
            <a  class="sub-item" id="reportAccountability"
              >Accountability Receipt</a
            >
          </div>
        </div>
        <div class="item"><a>Account Settings</a></div>
        <div class="item"><a>Logout</a></div>
      </div>
    </div>
    <div class="content">
      <div class="inner-content">
        <div class="header">
          <div class="header">
            <i class="fa-solid fa-bars-staggered show-sidebar"></i>
            <h3 id="headerTitle">Dashboard</h3>
            <div class="logout" style="text-align: end">
              <i class="fa-solid fa-envelope"
                ><sup style="font-size: 0.8rem; margin-top: -20px">+10</sup></i
              >
              <a href="">Logout<i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
          </div>
        </div>