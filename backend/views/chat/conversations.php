<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<html>
<head>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css"
          rel="stylesheet"

</head>
<body>
<div class="container">
    <div class="messaging">
        <div class="inbox_msg">
            <div class="inbox_people">
                <div class="headind_srch">
                    <div class="recent_heading">
                        <h4>Recent</h4>
                    </div>
                    <div class="srch_bar">
                        <div class="stylish-input-group">
                            <input type="text" class="search-bar" placeholder="Search">
                            <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span></div>
                    </div>
                </div>
                <div class="inbox_chat">
                    <?php foreach ($conversations as $conversation): ?>
                        <div class="chat_list chat-active" onclick="myConversation()" style="cursor: pointer;">
                            <div class="chat_people">
                                <div class="chat_img"><img src="<?php echo $conversation->user->userProfile->avatar ?>"
                                                           alt="sunil"></div>
                                <div class="chat_ib">
                                    <h5><?php echo $conversation->user->userProfile->getFullName() ?? "" ?><span
                                                class="chat_date">Dec 25</span></h5>
                                    <p><?php echo $conversation->last_message ?></p>

                                </div>
                            </div>
                        </div>


                    <?php endforeach; ?>
                </div>
            </div>


<!--            <div class="mesgs" id="chatDis" style="display: none">-->
            <div class="mesgs" id="chatDis">
                <div class="msg_history">
                    <?php foreach ($messages as $message): ?>
                        <?php if ($message->sender == Yii::$app->user->id): ?>
                            <div class="outgoing_msg">
                                <div class="sent_msg">
                                    <p><?php echo $message->message ?></p>
                                    <span class="time_date"> 11:01 AM    |    June 9</span></div>
                            </div>
                        <?php else: ?>
                            <div class="incoming_msg">
                                <div class="incoming_msg_img"><img
                                            src="<?php echo $avatar ?>" alt="sunil">
                                </div>
                                <div class="received_msg">
                                    <div class="received_withd_msg">
                                        <p><?php echo $message->message ?></p>
                                        <span class="time_date"> 11:01 AM    |    June 9</span></div>
                                </div>
                            </div>

                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>
                <div class="type_msg">
                    <div class="input_msg_write">
                        <input type="text" class="write_msg" placeholder="Type a message"/>
                        <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o"
                                                                      aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</body>

</html>
<script>
    function myConversation() {
        document.getElementById("chatDis").style.display = "block";
    }
</script>