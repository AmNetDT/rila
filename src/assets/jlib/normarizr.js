// JavaScript Document
var ajaxLoading = false;
var ajaxLoadingUsers = false;
var ajaxLoadingUsersEdit = false;


$(document).ready(function() {
   
    $(document).on('click', '.sys_edit_users', function() {
        $("#loader_httpFeed").show();
        let username = $(this).attr("lang");
        let id = $(this).attr("id");

        if (!ajaxLoadingUsersEdit) {

            ajaxLoadingUsersEdit = true;

            let req = {
                employee_id: id
            }

            $.ajax({
                type: "POST",
                url: "view/users/editusers",
                data: req,
                cache: false,
                success: function(msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Edit User -> ${username.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxLoadingUsersEdit = false;
                },
                error: function(xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
    })

    $(document).on('click', '.sys_regts', function() {
        $("#loader_httpFeed").show();
        if (!ajaxLoadingUsers) {

            ajaxLoadingUsers = true;
            $.ajax({
                type: "POST",
                url: "view/users/register",
                cache: false,
                success: function(msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "Register Users",
                        "content": msg
                    });
                    ajaxLoadingUsers = false;
                },
                error: function(xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
    })


});