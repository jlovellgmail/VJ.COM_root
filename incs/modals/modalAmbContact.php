<?php 
$AID = $_GET["AID"];
$FName = $_GET["Name"];
?>
<form class="generalForm modalForm" id="ambContactFrm" action="ambassadorContact_action.php" method="post">
    <div class="row">
        <div class="lg-twelve">
            <h2 class="caps textCenter">Contact <?php echo $FName; ?></h2>
            <br />
            <div id="ContactDiv">
                <input type="text" id="ContactName" name="Name" placeholder="First and Last Name" value="">
                <input type="text" id="ContactEmail" name="Email" placeholder="Email Address" value="">
                <textarea placeholder="Comments" id="ContactComments" name="Comments"></textarea>
                <input type="Hidden" id="ContactAID" name="AID" value="<?php echo $AID; ?>"/>
            </div>
        </div>
    </div>
    <br>
    <div id="ContactBtn" class="generalFormSubmit textCenter">
        <a type="button" class="fillBtn" href="javascript:validateContact();">Submit</a>
    </div>
</form>