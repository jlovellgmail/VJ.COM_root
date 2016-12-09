<?php 
$AID = $_GET["AID"];
$FName = $_GET["Name"];
?>

<form class="generalForm modalForm" id="trunkShowFrm" action="ambassadorTrunk_action.php" method="post">
    <div class="row">
        <div class="lg-twelve">
            <h2 class="caps textCenter">Request a Trunk Show  with <?php echo $FName; ?></h2>
            <br />
            <div id="trunkDiv">
                <p>
                    Trunk show description non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assum
                </p>
                <input type="text" id="TrunkName" name="Name" placeholder="First and Last Name" value="">
                <input type="text" id="TrunkEmail" name="Email" placeholder="Email Address" value="">
                <input type="text" id="TrunkTelephone" name="Telephone" placeholder="Telephone" value="">
                <input type="text" id="TrunkLocation" name="Location" placeholder="Location Name and Address" value="">
                <textarea placeholder="Comments" id="TrunkComments" name="Comments"></textarea>
                <input type="Hidden" id="TrunkAID" name="AID" value="<?php echo $AID; ?>"/>
            </div>
        </div>
    </div>
    <br>
    <div id="trunkBtn" class="generalFormSubmit textCenter">
        <a type="button" class="fillBtn" href="javascript:validateTrunk();">Submit</a>
    </div>
</form>