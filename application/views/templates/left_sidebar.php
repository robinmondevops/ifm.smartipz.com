<div class="profile-usermenu">
    <ul class="nav">


        <li class="<?php echo $menu == 'photos'?'active':''; ?>">
            <a href="<?php echo site_url('photos'); ?>">
                <i class="icon-picture"></i>Manage Photos </a>
        </li>

        <li class="<?php echo $menu == 'mailbox'?'active':''; ?>">
            <a href="<?php echo site_url('mailbox'); ?>">
                <i class="icon-group"></i> Mailbox
                <span style="background-color: <?php echo ($friend_request_count>0)?'red':''; ?>"
                      class="badge"><?php echo $friend_request_count; ?></span>

            </a>
        </li>
        
        <li class=" <?php echo $menu == 'notifications'?'active':''; ?>">
            <a href="<?php echo site_url('notifications'); ?>">
                <i class="icon-cogs"></i> Notifications

                <span style="background-color: <?php echo ($notification_count>0)?'red':''; ?>"
                      class="badge"><?php echo $notification_count; ?></span>
            </a>
        </li>

        <li class=" <?php echo $menu == 'messages'?'active':''; ?>">
            <a href="<?php echo site_url('messages'); ?>">
                <i class="icon-comment"></i> Chats

                <span style="background-color: <?php echo ($messages_count>0)?'red':''; ?>"
                      class="badge"><?php echo $messages_count; ?></span>
            </a>
        </li>


    </ul>
</div>   