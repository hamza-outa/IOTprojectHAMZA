<?php
error_reporting(E_WARNING);
// Include configuration file
require_once 'config.php';

// Include User class
require_once 'user_class.php';

// Initialize User class
$user = new User();

// Define filters
$conditions = array();

// If search request is submitted
if(!empty($_POST['keywords'])){
    $conditions['search'] = array('name' => $_POST['keywords'], 'numbval' => $_POST['keywords']);
}

// If filter request is submitted
if(!empty($_POST['filter'])){
    $sortVal = $_POST['filter'];
    $sortArr = array(
        'new' => array(
            'order_by' => 'created DESC'
        ),
        'asc'=>array(
            'order_by'=>'name ASC'
        ),
        'desc'=>array(
            'order_by'=>'name DESC'
        ),
        'active'=>array(
            'where'=>array('status' => 1)
        ),
        'inactive'=>array(
            'where'=>array('status' => 0)
        )
    );
    $sortKey = key($sortArr[$sortVal]);
    $conditions[$sortKey] = $sortArr[$sortVal][$sortKey];
}

// Get members data based on search and filter
$members = $user->getRows($conditions);

if(!empty($members)){
    $i = 0;
    foreach($members as $row){ $i++;
        echo '<tr>';
        echo '<td>'.$i.'</td>';
        echo '<td>'.$row['id'].'</td>';
        echo '<td>'.$row['name'].'</td>';
        echo '<td>'.$row['numbVal'].'</td>';
        echo '<td>'.$row['phone'].'</td>';
        echo '</tr>';
    }
}else{
    echo '<tr><td colspan="7">No members(s) found...</td></tr>';
}
exit;
?>
