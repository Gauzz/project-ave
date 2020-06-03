<?php 
require '../../includes/functions.php';
 
$queryforAllmsg=select("contact","read_status='0' AND NOT isAdmin='1' AND NOT trash='1'");
$noOfUnreadMsg= howMany($queryforAllmsg);    
$queryGetUnreadMsg=select("contact","NOT isAdmin='1' AND NOT trash='1' ORDER BY created_at DESC LIMIT 5");
while ($getUnreadMsg=fetch($queryGetUnreadMsg)) {
?>
<li>
    <a href="https://<?php echo site_url; ?>/admin/view-email.php?action=view-inbox">
        <span class="photo">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYm-KcyvHy3PDkmh0V9KzkUk26255h0RwthshiaoanTnfH2B_IRg" class="img-circle" alt=""> </span>
        <span class="subject">
            <span class="from text-capitalize mr-1"><?= $getUnreadMsg["name"] ?></span>
            <?php if ($getUnreadMsg["read_status"]=='0'): ?>
            	<span style="float: none;font-size: 8px;padding: 4px 8px;" class="label label-rouded label-menu label-danger">Unread</span>
            <?php endif ?>
            <span class="time font-weight-bold"><?php echo timeAgo($getUnreadMsg["created_at"])?> </span>
        </span>
        <span class="message"><?= $getUnreadMsg["msg"]; ?></span>
    </a>
</li>
<?php } ?>
<input type="hidden" value="<?= $noOfUnreadMsg?>" id="unreadMsg">