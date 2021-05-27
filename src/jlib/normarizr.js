// JavaScript Document
var ajaxLoading = false;
var ajaxLoadingIssue = false;
var ajaxLoadingUsers = false;
var ajaxLoadingUsersEdit = false;
var ajaxStaffDetailsView = false;
var ajaxRegisterNewUser= false;


$(document).ready(function() {

    //Create New User Pop up Window with Ajax jquery
    $(document).on('click', '.reg_user', function (e) {
        $("#loader_httpFeed").show();
        
        if (!ajaxRegisterNewUser) {

            ajaxRegisterNewUser = true;
            $.ajax({
                type: "POST",
                url: "view/users/register",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "Create New User",
                        "content": msg
                    });
                    ajaxRegisterNewUser = false;
                },
                error: function (xhr) {
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
        e.preventDefault();
    })

    //Create Campus Pop up Window with Ajax jquery
    $(document).on('click', '.reg_campus', function () {
        $("#loader_httpFeed").show();
        if (!ajaxLoadingUsers) {

            ajaxLoadingUsers = true;
            $.ajax({
                type: "POST",
                url: "view/new_campus/create_campus",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "Create New Campus",
                        "content": msg
                    });
                    ajaxLoadingUsers = false;
                },
                error: function (xhr) {
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

    //Update Campus Pop up Window with Ajax jquery
    $(document).on('click', '.edit_campus', function () {
        $("#loader_httpFeed").show();
        let name = $(this).attr("lang");
        let id = $(this).attr("id");


        if (!ajaxLoadingUsers) {
           
            ajaxLoadingUsers = true;
            $.ajax({
                type: "POST",
                url: "view/new_campus/update",
                data: {
                    campus_id:id
                },
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Update Campus -> ${name.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxLoadingUsers = false;
                },
                error: function (xhr) {
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


    //Update User Pop up Window with Ajax jquery
    $(document).on('click', '.edit_user', function () {
        $("#loader_httpFeed").show();
        let username = $(this).attr("lang");
        let id = $(this).attr("id");


        if (!ajaxLoadingUsers) {

            ajaxLoadingUsers = true;
            $.ajax({
                type: "POST",
                url: "view/users/update_user",
                data: {
                    user_id: id
                },
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Update User -> ${username.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxLoadingUsers = false;
                },
                error: function (xhr) {
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


    //Universal Delete Confirm Message box with Ajax jquery
    $(document).on('click', '.delete_row', function () {
        let _id = $(this).attr("id");
        let table = $(this).attr("lang");

        dalert.ReplaceConfirm();
       
        confirm("Are you sure you want to delete?", "Confirm Delete!", function (result) {
            if (result) {
                $.ajax({
                    url: "crud/delete",
                    method: "POST",
                    data: {
                        _id: _id,
                        table: table

                    },
                    success: function (data) {
                        dalert.alert(data, "Message",
                            {
                                messageFontColor: '#333333',
                                messageBgColor: '#ffffff',
                                tittleBgColor: '#535353',
                                tittleFontColor: '#ffffff'
                            });
                        dataTable.ajax.reload('abdganiu');
                    }
                });
            }
            else {
                dalert.alert("Delete Cancelled!", "Message",
                    {
                        messageFontColor: '#333333',
                        messageBgColor: '#ffffff',
                        tittleBgColor: '#535353',
                        tittleFontColor: '#ffffff'
                    });
                return false;
            }
        },
        {
                messageFontColor: '#333333',
                messageBgColor: '#ffffff',
                tittleBgColor: '#535353',
                tittleFontColor: '#ffffff'
            });

    });
   

    //User/Student Delete Confirm Message box with Ajax jquery
    $(document).on('click', '.delete_user_or_student', function () {
        
        let syscategory = $(this).attr("lang");
        let member_id = $(this).attr("title");

        //alert(member_id)
        dalert.ReplaceConfirm();

        confirm("Are you sure you want to delete the user completely from the system?", "Confirm Delete!", function (result) {
            if (result) {
                $.ajax({
                    url: "crud/delete_user",
                    method: "POST",
                    data: {
                        
                        syscategory: syscategory,
                        member_id: member_id
                    },
                    success: function (data) {
                        dalert.alert(data, "Message",
                            {
                                messageFontColor: '#333333',
                                messageBgColor: '#ffffff',
                                tittleBgColor: '#535353',
                                tittleFontColor: '#ffffff'
                            });
                        dataTable.ajax.reload('abdganiu');
                    }
                });
            }
            else {
                dalert.alert("Delete Cancelled!", "Message",
                    {
                        messageFontColor: '#333333',
                        messageBgColor: '#ffffff',
                        tittleBgColor: '#535353',
                        tittleFontColor: '#ffffff'
                    });
                return false;
            }
        },
            {
                messageFontColor: '#333333',
                messageBgColor: '#ffffff',
                tittleBgColor: '#535353',
                tittleFontColor: '#ffffff'
            });

    });



});


