$(document).ready(function(){
    $("#current_pwd").keyup(function(){
        var current_pwd = $("#current_pwd").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/check-password',
            data:{current_pwd:current_pwd},
            success:function(resp){
                if(resp == "false"){
                    $("#verify_pwd").html("invalid password");
                }else {
                    $("#verify_pwd").html("correct password");
                }
            },
            error:function(){
                console.log('error');
            }
        });
    });

    $(document).on('click', ".update-status", function(){
        var status = $(this).children("i").attr("status");
        var page_id = $(this).attr("pid");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"post",
            url:"/admin/update-page-status",
            data:{status:status, page_id:page_id},
            success: function(resp){
                if(resp['status'] == 0)
                {
                    $("#cms_page_"+resp['page_id']).html('<i class="fas fa-toggle-off" style="color:grey" status="inactive"></i>');
                }else if(resp['status'] == 1){
                    $("#cms_page_"+resp['page_id']).html('<i class="fas fa-toggle-on" status="active"></i>');
                }
            },
            error:function(){
                alert("error");
            }
        });
    });

    $(document).on('click', '.confirmDelete', function(){
        var record = $(this).attr('record');
        var recordid = $(this).attr('recordid');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              window.location.href = "/admin/"+record+"/"+recordid;
            }
          })
    });

    $(document).on('click', ".update-sub-admin-status", function(){
        var status = $(this).children("i").attr("status");
        var sub_admin_id = $(this).attr("said");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"post",
            url:"/admin/update-sub-admin-status",
            data:{status:status, sub_admin_id:sub_admin_id},
            success: function(resp){
                if(resp['status'] == 0)
                {
                    $("#sub_admin_"+resp['sub_admin_id']).html('<i class="fas fa-toggle-off" style="color:grey" status="inactive"></i>');
                }else if(resp['status'] == 1){
                    $("#sub_admin_"+resp['sub_admin_id']).html('<i class="fas fa-toggle-on" status="active"></i>');
                }
            },
            error:function(){
                alert("error");
            }
        });
    });
});
