// JavaScript Document
var ajaxLoading = false;
var ajaxLoadingIssue = false;
var ajaxLoadingUsers = false;
var ajaxLoadingUsersEdit = false;
var ajaxStaffDetailsView = false;
var ajaxLoadingOutletUpdatePermission = false;
var ajaxLoadingCustomersCards = false;
var ajaxLoadingOutletCards = false;
var ajaxLoadingCompitition = false;


$(document).ready(function() {

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


    //Staff Details View Pop Up Window with Ajax jquery
    $(document).on('click', '.view_staff_details', function () {
        $("#loader_httpFeed").show();
        let name = $(this).attr("lang");
        let id = $(this).attr("id");


        if (!ajaxStaffDetailsView) {

            ajaxStaffDetailsView = true;
            $.ajax({
                type: "POST",
                url: "view/staff/view_all",
                data: {
                    user_id: id
                },
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Details of ${name.toUpperCase()}`,
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
   


});


