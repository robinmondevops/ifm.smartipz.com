$(document).ready(function(){

    var users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '',
        remote: {
            url: base_url+'search/typeahead_search?query=%QUERY',
            wildcard: '%QUERY'
        }
    });


    $('#typeahead_search').typeahead(null, {
        name: 'typeahead_search',
        display: 'value',
        source: users,
    });


    $(document).on('mouseover', '.notify_request', function(){
        
        var $user = $(this).data('user'); 

        var $url = site_url+'friends/update_req_notify/'+$user;

        $.ajax({
            url: $url,
            type: 'post',
            success: function(data) {

                if(data.status == 'success'){
                    
                    $('.badge_request').addClass('hidden');
                       
                }
                
            },
        });

    })


    

    $(document).on('mouseover', '.notify_like', function(){
        
        var $user = $(this).data('user'); 

        var $url = site_url+'friends/update_req_like/'+$user;

        $.ajax({
            url: $url,
            type: 'post',
            success: function(data) {

                if(data.status == 'success'){
                    
                    $('.badge_like').addClass('hidden');
                       
                }
                
            },
        });

    })


    // $(document).on('mouseover', '.notify_share', function(){
        
    //     var $user = $(this).data('user'); 

    //     var $url = site_url+'friends/update_req_share/'+$user;

    //     $.ajax({
    //         url: $url,
    //         type: 'post',
    //         success: function(data) {

    //             if(data.status == 'success'){
                    
    //                 $('.badge_share').addClass('hidden');
                       
    //             }
                
    //         },
    //     });

    // })






});



$(document).on('click', '.notify_request', function(){
    
    var $user = $(this).data('user'); 

    var $url = site_url+'friends/update_req_notify/'+$user;

    $.ajax({
        url: $url,
        type: 'post',
        success: function(data) {

            if(data.status == 'success'){
               $('.badge_request').addClass('hidden');
            }
            
        },
    });

})



$(document).on('click', '.accept_req', function() {

    var $this = $(this);

    var $user_id = $this.data('id');
    var $friend_id = $this.data('friend');
    
    var $url = site_url+'friends/accept_request';

     
    $.ajax({
        url: $url,   
        type: 'post',
        data: { user_id:$user_id,friend_id:$friend_id },
        success: function(data) {

            if(data.status == 'success'){
                $('#msg_box').html('<div class="alert alert-success alert-dismissable"><button class="close" type="button" data-dismiss="alert" aria-hidden="true"></button>Request Accepted Successfully</div>');
                $('#'+$friend_id).html('Friends');
                $('#'+$friend_id).removeClass('accept');
                $('#'+$friend_id).addClass('friends');
                $('#'+$friend_id).attr('data-action', 'friends');   
                $('#notify_'+$friend_id).remove();   
            }
            
            
            
        },
    });

});