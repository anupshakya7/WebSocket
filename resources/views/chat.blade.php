<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/chat.css')}}">
    <title>Chat</title>
</head>

<body>
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-md-12">

                    <div class="box box-warning direct-chat direct-chat-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Chat Messages</h3>

                            <div class="box-tools pull-right">
                                <span data-toggle="tooltip" title="" class="badge bg-yellow"
                                    data-original-title="3 New Messages">20</span>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title=""
                                    data-widget="chat-pane-toggle" data-original-title="Contacts">
                                    <i class="fa fa-comments"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="box-body">

                            <div class="direct-chat-messages" id="chat-section">

                            </div>
                        </div>

                        <div class="box-footer">
                            <form action="#" method="post">
                                <div class="input-group">
                                    <input type="hidden" id="username" value="{{$name}}">
                                    <input type="text" name="message" placeholder="Type Message ..."
                                        class="form-control" id="chat_message">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-warning btn-flat" onclick="broadcastMethod()">Send</button>
                                    </span>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    @vite('resources/js/app.js')
    <script>
        function broadcastMethod(){
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                url:"{{route('broadcast.chat')}}",
                type:'POST',
                data:{username:$("#username").val(),msg:$('#chat_message').val()},
                success:function(result){
                    
                },
                error:function(error){
                    console.log(error);
                },
            });
        }

        setTimeout(()=>{
            window.Echo.channel('chat_message').listen('Chat',(data)=>{
                newMessage = `  <div class="direct-chat-msg ${data.username === $('#username').val() ? 'right':''}">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left">${data.username}</span>
                                        <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                                    </div>

                                    <img class="direct-chat-img"
                                        src="https://img.icons8.com/color/36/000000/administrator-male.png"
                                        alt="message user image">

                                    <div class="direct-chat-text">
                                        ${data.message}
                                    </div>

                                </div>`;
                // console.log(data);
                $('#chat-section').append(newMessage);
                $('#chat_message').val('');
            });
        },500);

    </script>
</body>

</html>
