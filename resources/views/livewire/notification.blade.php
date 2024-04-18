<div class="dropdown">
    <button class="btn btn-gray" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
        <div class="position-relative">
            <i class="bi bi-bell-fill fs-4"></i>
            @if ($unread_notifications > 0)
                <div class="position-absolute bg-danger rounded-full d-flex justify-content-center align-items-center" style="top: 0; right: -2px; height: 15px; width: 15px; font-size: 10px">
                    <span class="text-white">{{$unread_notifications}}</span>
                </div> 
            @endif
        </div>
    </button>   
    <div class="dropdown-menu dropdown-menu-sm-end text-wrap py-0 text-start" style="width: 300px; height: 400px; overflow-y: scroll; overflow-wrap: break-word;">
        <div class="d-flex p-2 justify-content-between align-items-center bg-success mb-2">
            <div class="fw-bold text-white">Notification</div>
            <button type="button" class="text-white custom-button p-1" wire:click="deleteAllNotification"  onclick="deleteAllNotification({{json_encode($notifications)}}); event.stopPropagation();">Clear All</button>
        </div>
        @if (count($notifications) > 0)
            @foreach ($notifications as $notification)
            <div class="border-bottom" id="{{$notification->id}}">
                <div class="d-flex justify-content-between p-1 mb-1">
                    <div class="{{$notification->read_at == null ? 'bg-unreadNotif': ''}} clickToPage" wire:click="markAsReadNotification('{{Crypt::encrypt($notification->id)}}')"  url="{{$notification->data['url']}}" style="cursor: pointer">
                        <strong class="me-2">{{$notification->data['heading']}}</strong>
                            <span class="me-2">{{$notification->data['message']}}</span>
                            <div class="text-muted" style="font-size: 10px">
                                {{ Carbon\Carbon::parse($notification->created_at)->format('d-M-Y  g:i A' )}}
                            </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <button type="button" class="border-0 text-white bg-danger h-100" wire:click="deleteNotification('{{Crypt::encrypt($notification->id)}}')" onclick="deleteNotification('{{$notification->id}}')"><i class="bi bi-trash"></i></button>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="text-center">No Notification</div>
        @endif
    </div>

    <script>

        $('.clickToPage').click(function(e){
            e.stopPropagation();
            window.location.href = $(this).attr('url');
        })

       function clickToPage(url){
            window.location.href = url;
       }

       function deleteAllNotification(notifications){

                notifications.forEach(function(notification){
                    console.log(notification.id);
                    $('div#' + notification.id).fadeOut(500, function(){
                        $(this).remove();
                    });
                });
               
        }

        function deleteNotification(id){

                $('div#' + id).fadeOut(500, function(){
                    $(this).remove();
                });
        }
    </script>
</div>