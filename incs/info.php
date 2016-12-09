<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
include_once "/classes/Reg_User.class.php";
if ($adminEdit) {
    $UsrID = $_SESSION["AmbEditID"];
    $UsrPriv = $_SESSION["UsrPriv"];
}else {
    $UsrID = $_SESSION["UsrID"];
    $UsrPriv = $_SESSION["UsrPriv"];
}

$user = new Reg_User();
$user->initialize($UsrID);

$FName = $user->getVar("FName");
$LName = $user->getVar("LName");
$Email = $user->getVar("Email");

?>

<?php include '/incs/userAccountNav.php'; ?>

<div class="widthWrapper">
    <div class="tableWrapper tableHeight">
        <div class="cellWrapper">
            <?php if ($UsrPriv >= 80 || $adminEdit) { ?>
                <div class="row">
                    <div id="ambProfileDiv" class="sm-twelve md-eight"><?php include '/ambassador/incs/ambProfile.php'; ?></div><div class="sm-twelve md-ten lg-eight"><?php include '/ambassador/incs/ambInterview.php'; ?></div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>