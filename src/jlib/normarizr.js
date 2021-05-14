// JavaScript Document
var ajaxLoading = false;
var ajaxLoadingIssue = false;
var ajaxLoadingUsers = false;
var ajaxLoadingUsersEdit = false;
var ajaxLoadingModules = false;
var ajaxLoadingOutletUpdatePermission = false;
var ajaxLoadingCustomersCards = false;
var ajaxLoadingOutletCards = false;
var ajaxLoadingCompitition = false;


$(document).ready(function() {


    $(document).on('click', '.btn_permit_01', function() {
        //let ct = $('.permit_all_checks:checked').size();
        let counts = $(".counts_permission").val();
        //let def = counts-ct;
        //if(def > 0){
        outletUpdatePermission(counts);
        //}
    })

    $(document).on('click', '.btn_permit_02', function() {
        //let ct = $('.permit_all_checks:checked').size();
        let counts = $(".counts_permission").val();
        //let def = counts-ct;
        //if(def > 0){
        outletUpdatePermission(counts);
        //}
    })

    let outletUpdatePermission = (count) => {

        $("#loader_httpFeed").show();
        let mCount = Number(count) + 1;
        let usesArray = [];
        let i = 1;

        for (i; i < mCount; i++) {
            let monVals;
            if ($(".permitOutlet" + i).is(':checked')) {
                monVals = $(".permitOutlet" + i).val() + '~true';
            } else {
                monVals = $(".permitOutlet" + i).val() + '~false';
            }
            usesArray.push(monVals);
        }

        let req = {
            outletid: usesArray
        }

        $.ajax({
            type: "POST",
            url: "filesmanagers/outlet_permission/salesserver.php",
            data: req,
            dataType: "json",
            cache: false,
            success: function(resp) {
                $("#loader_httpFeed").hide();
                dalert.alert(resp.msg);
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

    $(document).on('click', '.chkll_permits', function() {
        if ($(this).is(":checked")) {
            $(".permit_all_checks").prop("checked", true);
        } else if ($(this).is(":not(:checked)")) {
            $(".permit_all_checks").prop("checked", false);
        }
    });


    $(document).on('click', '.btn_outlet_update_permission', function() {
        $("#loader_httpFeed").show();
        let id = $(this).attr("id");
        let username = $(this).attr("lang");

        if (!ajaxLoadingOutletUpdatePermission) {

            ajaxLoadingOutletUpdatePermission = true;

            let req = {
                id: id
            }

            $.ajax({
                type: "POST",
                url: "filesmanagers/outlet_permission/lightbox_outlet_permission.php",
                data: req,
                cache: false,
                success: function(msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Outlet Update Permission-> ${username.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxLoadingOutletUpdatePermission = false;
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

    $(document).on('click', '.users_app_modules_dev', function() {
        $("#loader_httpFeed").show();
        let username = $(this).attr("lang");
        let id = $(this).attr("id");

        if (!ajaxLoadingModules) {

            ajaxLoadingModules = true;

            let req = {
                employee_id: id
            }

            $.ajax({
                type: "POST",
                url: "filesmanagers/user_modules/module_light_box",
                data: req,
                cache: false,
                success: function(msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Users App Module -> ${username.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxLoadingModules = false;
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
                url: "filesmanagers/users/editusers",
                data: req,
                cache: false,
                success: function(msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Edit User Info -> ${username.toUpperCase()}`,
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

    $(document).on('click', '.reg_campus', function() {
        $("#loader_httpFeed").show();
        if (!ajaxLoadingUsers) {

            ajaxLoadingUsers = true;
            $.ajax({
                type: "POST",
                url: "view/new_campus/register",
                cache: false,
                success: function(msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "Add Campus",
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

    //$(".btn_issue").on('click',function() {
    $(document).on('click', '.btn_issue', function() {
        let switcher = $(".btn_status_action").children("option:selected").val();
        let username = $(this).attr("lang");
        let id = $(this).attr("id");
        let issues = $(this).attr("nig");
        let actions = $(this).attr("eng");
        $("#loader_httpFeed").show();

        if (!ajaxLoadingIssue) {

            ajaxLoadingIssue = true;

            let req = {
                id: id,
                issues: issues,
                actions: actions
            };

            if (switcher.trim() === "1") {
                $.ajax({
                    type: "POST",
                    url: "filesmanagers/userissues/lightbox_issue.php",
                    data: req,
                    cache: false,
                    success: function(msg) {
                        $("#loader_httpFeed").hide();
                        new top.PopLayer({
                            "title": "User Issue-> " + username.toUpperCase(),
                            "content": msg
                        });
                        ajaxLoadingIssue = false;
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
            } else if (switcher.trim() === "2") {
                $.ajax({
                    type: "POST",
                    url: "filesmanagers/userissues/lightbox_action.php",
                    data: req,
                    cache: false,
                    success: function(msg) {
                        $("#loader_httpFeed").hide();
                        new top.PopLayer({
                            "title": "Action Plan-> " + username.toUpperCase(),
                            "content": msg
                        });
                        ajaxLoadingIssue = false;
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
        }
    });


    $(document).on('click', '.butoss_issues', function() {
        //$("#butoss").on('click',function() {	
        $("#loader_httpFeed").show();
        let mIssues = $("input[type='radio'].issue_vals:checked").val();
        let issuename = $("input[type='radio'].issue_vals:checked").attr("lang");
        let id = $(".mid").val();

        if (mIssues !== null && mIssues.trim() !== "undefined" && mIssues !== "") {

            let req = {
                id: id,
                mIssues: mIssues
            }

            $.ajax({
                type: "POST",
                url: "filesmanagers/userissues/update_ussue.php",
                data: req,
                cache: false,
                dataType: "json",
                success: function(xhr) {
                    $('.rst' + id).attr("nig", mIssues);
                    $('#myIssues' + id).html(issuename);
                    $("#loader_httpFeed").hide();
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

    $(document).on('click', '.butoss_actions', function() {
        //$("#butoss").on('click',function() {	
        $("#loader_httpFeed").show();
        let mActions = $("input[type='radio'].actions_vals:checked").val();
        let actionname = $("input[type='radio'].actions_vals:checked").attr("lang");
        let id = $(".mid").val();
        let sids = $(".sids").val();

        if (sids === "") {
            $("#loader_httpFeed").hide();
            dalert.alert("Action cant be taken without issue");
        } else {

            if (mActions !== null && mActions.trim() !== "undefined" && mActions !== "") {

                let req = {
                    id: id,
                    mActions: mActions,
                    sids: sids
                }

                $.ajax({
                    type: "POST",
                    url: "filesmanagers/userissues/update_action_plan.php",
                    data: req,
                    cache: false,
                    dataType: "json",
                    success: function(xhr) {
                        $('.rst' + id).attr("eng", mActions);
                        $('#myaction' + id).html(actionname);
                        $("#loader_httpFeed").hide();
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
        }
    })

    $(document).on('click', '.btn_sales_route', function() {

        $("#loader_httpFeed").show();
        let weeks = $(".btn_weeks_sales_route_plan").children("option:selected").val();
        let days = $(".btn_days_sales_route_plan").children("option:selected").val();
        let id = $(this).attr("id");
        let username = $(this).attr("lang");

        if (weeks === "0") {
            $("#loader_httpFeed").hide();
            dalert.alert("Please select Weeks");
        } else {

            if (!ajaxLoading) {

                ajaxLoading = true;

                let req = {
                    weeks: weeks,
                    id: id
                }

                $.ajax({
                    type: "POST",
                    url: "filesmanagers/sales_route_plan/lightbox_sales_route.php",
                    data: req,
                    cache: false,
                    success: function(msg) {
                        $("#loader_httpFeed").hide();
                        new top.PopLayer({
                            "title": `Sales Route Plan (Week ${weeks}) -> ${username.toUpperCase()}`,
                            "content": msg
                        });
                        ajaxLoading = false;
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
        }
    })

    $(document).on('click', '.find_sales_route_y', function() {
        let counts = $(".counts").val();
        let eid = $(".employee_outlets").val();
        let weeks = $(".route_weeks_recycle").val();
        if (counts !== "0") {
            salesRouteCycle(counts, eid, weeks);
        }
    })

    $(document).on('click', '.find_sales_route_x', function() {
        let counts = $(".counts").val();
        let eid = $(".employee_outlets").val();
        let weeks = $(".route_weeks_recycle").val();
        if (counts !== "0") {
            salesRouteCycle(counts, eid, weeks);
        }
    })

    let salesRouteCycle = (count, eid, weeks) => {

        let mCount = Number(count) + 1;
        let mWeek = weeks;
        let monArray = [];
        let tueArray = [];
        let wedArray = [];
        let thurArray = [];
        let friArray = [];
        let satArray = [];
        let sunArray = [];
        let recycleidArray = [];
        let i = 1;
        $("#loader_httpFeed").show();

        for (i; i < mCount; i++) {

            let monHolder = "0";
            let monVals = $(".mon" + i + ":checked").val();

            let tueHolder = "0";
            let tueVals = $(".tue" + i + ":checked").val();

            let wedHolder = "0";
            let wedVals = $(".wed" + i + ":checked").val();

            let thurHolder = "0";
            let thurVals = $(".thur" + i + ":checked").val();

            let friHolder = "0";
            let friVals = $(".fri" + i + ":checked").val();

            let satHolder = "0";
            let satVals = $(".sat" + i + ":checked").val();

            let sunHolder = "0";
            let sunVals = $(".sun" + i + ":checked").val();

            let rec = $(".rg_q" + i).val();

            if (monVals == "2") {
                monHolder = monVals;
            }

            if (tueVals == "3") {
                tueHolder = tueVals;
            }

            if (wedVals == "4") {
                wedHolder = wedVals;
            }

            if (thurVals == "5") {
                thurHolder = thurVals;
            }

            if (friVals == "6") {
                friHolder = friVals;
            }

            if (satVals == "7") {
                satHolder = satVals;
            }

            if (sunVals == "1") {
                sunHolder = sunVals;
            }

            monArray.push(monHolder);
            tueArray.push(tueHolder);
            wedArray.push(wedHolder);
            thurArray.push(thurHolder);
            friArray.push(friHolder);
            satArray.push(satHolder);
            sunArray.push(sunHolder);
            recycleidArray.push(rec);
        }

        let req = {
            monArray: monArray,
            tueArray: tueArray,
            wedArray: wedArray,
            thurArray: thurArray,
            friArray: friArray,
            satArray: satArray,
            sunArray: sunArray,
            recycleidArray: recycleidArray,
            mWeek: mWeek
        }

        $.ajax({
            type: "POST",
            url: "filesmanagers/sales_route_plan/salesserver.php",
            data: req,
            dataType: "json",
            cache: false,
            success: function(resp) {
                dalert.alert(resp.msg);
                $("#loader_httpFeed").hide();
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

    $(document).on('click', '.chkll', function() {
        if ($(this).is(":checked")) {
            $(".chdall_may").prop("checked", true);
        } else if ($(this).is(":not(:checked)")) {
            $(".chdall_may").prop("checked", false);
        }
    });

    $(document).on('click', '.btn_regis_01', function() {
        $("#loader_httpFeed").show();
        userRegistration();
        return false;
    })

    $(document).on('click', '.btn_regis_02', function() {
        $("#loader_httpFeed").show();
        userRegistration();
        return false;
    })

   
    $(document).on('click', '.dlete_mod_remove', function() {
        $("#loader_httpFeed").show();
        let id = $(this).attr("id");
        let dataString = "id=" + id;
        $.ajax({
            type: "POST",
            url: "localapi/api/Module/disable",
            data: dataString,
            dataType: "json",
            success: function(xhr) {
                let callBackObject = xhr.status;

                if (callBackObject == 400) {

                    Swal.fire({
                        type: 'error',
                        text: xhr.statusmsg
                    })

                } else {
                    //$('.include_tables').html()
                    $('.clickModule' + id).remove();
                }
                $("#loader_httpFeed").hide();
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
        return false;
    })


    $(document).on('click', '.r_addmodules', function() {
        $("#loader_httpFeed").show();
        $.ajax({
            type: "POST",
            url: "localapi/api/Module/enable",
            data: $('.add_modules_to_users').serialize(),
            dataType: "json",
            success: function(xhr) {
                let callBackObject = xhr.status;
                $("#loader_httpFeed").hide();
                if (callBackObject == 400) {

                    Swal.fire({
                        type: 'error',
                        text: xhr.statusmsg
                    })

                } else {
                    //$('.include_tables').html()
                    $('.include_table').append(xhr.data)
                }

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
        return false;
    })

    $(document).on('click', '._logout', function() {
        let req = {
            id: "0"
        };

        $("#loader_httpFeed").show();
        $.ajax({
            type: "POST",
            url: "filesmanagers/login/logout",
            data: req,
            dataType: "json",
            cache: false,
            success: function(resData) {
                if (Number(resData.status) == 200) {
                    location.href = 'index.php';
                }
            },
            error: function(xhr) {
                if (xhr.status == 404) {
                    $("#loader_httpFeed").hide();
                    dalert.alert("internet connection not working");
                } else {
                    $("#loader_httpFeed").hide();
                    dalert.alert("internet is down");
                }
            }
        });
        return false;
    })

    $(document).on('click', '.btn_customers_cards', function() {
        $("#loader_httpFeed").show();
        let id = $(this).attr("id");
        let username = $(this).attr("lang");

        if (!ajaxLoadingCustomersCards) {

            ajaxLoadingCustomersCards = true;

            let req = {
                id: id
            }

            $.ajax({
                type: "POST",
                url: "filesmanagers/outlet_cards/lightbox_customer_card.php",
                data: req,
                cache: false,
                success: function(msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Customers Cards-> ${username.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxLoadingCustomersCards = false;
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

    $(document).on('click', '.btn_cards_fetch', function() {
        $("#loader_httpFeed").show();
        let urno = $(this).attr("lang");

        if (!ajaxLoadingOutletCards) {
            ajaxLoadingOutletCards = true;
            let req = {
                urno: urno
            }

            $.ajax({
                type: "POST",
                url: "filesmanagers/outlet_cards/fetch.php",
                data: req,
                cache: false,
                success: function(msg) {
                    $("#fetch_here").html(msg)
                    $("#loader_httpFeed").hide();
                    ajaxLoadingOutletCards = false;
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

    $(document).on('click', '.my_card_update', function() {
        let sn = $(this).attr("id");
        let custname = $(".custname" + sn).val();
        let conname = $(".conname" + sn).val();
        let addre = $(".addre" + sn).val();
        let clang = $(".clang" + sn).val();
        let cphone = $(".cphone" + sn).val();
        let clatlng = $(".clatlng" + sn).val();
        let ctype = $(".ctype" + sn).val();
        let cclass = $(".cclass" + sn).val();

        $('input[type=text].fname_apps').val(custname.toUpperCase());
        $('input[type=text].cname_app').val(conname.toUpperCase());
        $('input[type=text].cadres_app').val(addre.toUpperCase());
        $('input[type=text].clang_app').val(clang.toUpperCase());
        $('input[type=text].cphone_app').val(cphone.toUpperCase());
        $('input[type=text].clatlng').val(clatlng.toUpperCase());
        $('input[type=text].ctype_app').val(ctype.toUpperCase());
        $('input[type=text].class_app').val(cclass.toUpperCase());
        $('input[type=hidden].urno_autos').val(sn);
    })

    $(document).on('click', '.btn_regis_02_cards', function() {

        let req = {
            id: $('input[type=hidden].urno_autos').val()
        }

        if ($('input[type=hidden].urno_autos').val().trim() != '') {
            $("#loader_httpFeed").show();
            $.ajax({
                type: "POST",
                url: "filesmanagers/outlet_cards/salesserver.php",
                data: req,
                dataType: "json",
                cache: false,
                success: function(xhr) {
                    $("#loader_httpFeed").hide();
                    if (xhr.status == '200') {
                        dalert.alert("Successful");
                        $('input[type=hidden]#e_empty').val('');
                        $('input[type=text]#e_empty').val('');
                    } else {
                        dalert.alert("Error, Please check your internet and retry");
                    }
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


    $(document).on('click', '.r_addcompetition', function() {

        if ($("#competion_name").val() === "") {
            dalert.alert("please enter competition brand name");
        } else {

            $("#loader_httpFeed").show();
            $.ajax({
                type: "POST",
                url: "filesmanagers/competition/servers.php",
                data: $('.add_competition_to_users').serialize(),
                dataType: "json",
                success: function(xhr) {

                    let callBackObject = xhr.status;
                    let data = xhr.data;

                    $("#loader_httpFeed").hide();
                    if (callBackObject == 200) {
                        $('.include_table_data').append(xhr.data)
                    } else {
                        dalert.alert("please try again");
                    }
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
        return false;
    })


    $(document).on('click', '.dlete_mod_remove_comptition', function() {
        $("#loader_httpFeed").show();
        let id = $(this).attr("id");
        let dataString = "id=" + id;
        $.ajax({
            type: "POST",
            url: "filesmanagers/competition/server.php",
            data: dataString,
            dataType: "json",
            success: function(xhr) {
                let callBackObject = xhr.status;
                $('.clickModuleCompition' + id).remove();
                $("#loader_httpFeed").hide();
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
        return false;
    })

    $(document).on('click', '.route_regis_00023', function() {

        $("#loader_httpFeed").show();
        let id = $(this).attr("id");
        let ed = $('.et_t_b_m' + id).val();

        if (ed.trim() == '') {
            $("#loader_httpFeed").hide();
            dalert.alert("field can not eb empty");
        } else {
            assignRouteToUsers(id, ed);
            return false;
        }
    })

    let assignRouteToUsers = (id, ed) => {

        let res = {
            id: id,
            edcode: ed
        }

        $.ajax({
            type: "POST",
            url: "filesmanagers/sales_route_plan/salesserver.php",
            data: res,
            dataType: "json",
            success: function(xhr) {
                if (xhr.status === 200) {
                    $('.r_m_r_oute_mappers' + id).empty();
                    $('.r_m_r_oute_mappers' + id).append(xhr.name.toUpperCase());
                    dalert.alert(xhr.msg);
                    $("#loader_httpFeed").hide();
                } else {
                    dalert.alert(xhr.msg);
                    $("#loader_httpFeed").hide();
                }
            },
            error: function(xhr) {
                if (xhr.status.trim() == 404) {
                    $("#loader_httpFeed").hide();
                    dalert.alert("internet connection working");
                } else {
                    $("#loader_httpFeed").hide();
                    dalert.alert("internet is down");
                }
            }
        });
    }

    $(document).on('click', '.btn_customers_cards_cust_op', function() {
        $("#loader_httpFeed").show();
        let id = $(this).attr("id");
        let username = $(this).attr("lang");

        if (!ajaxLoadingCustomersCards) {

            ajaxLoadingCustomersCards = true;

            let req = {
                id: id
            }

            $.ajax({
                type: "POST",
                url: "filesmanagers/salesmonitor/lightbox_customer_card.php",
                data: req,
                cache: false,
                success: function(msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Live Sales Monitor-> ${username.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxLoadingCustomersCards = false;
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

    $(document).on('click', '.btn_cards_fetch_controllers', function() {
        $("#loader_httpFeed").show();
        let outlet_id = $(this).attr("eng");
        let employee_id = $(this).attr("lang");

        if (!ajaxLoadingOutletCards) {

            ajaxLoadingOutletCards = true;

            let req = {
                outlet_id: outlet_id,
                employee_id: employee_id
            }

            $.ajax({
                type: "POST",
                url: "filesmanagers/salesmonitor/fetch.php",
                data: req,
                cache: false,
                success: function(msg) {
                    $("#fetch_here").html(msg)
                    $("#loader_httpFeed").hide();
                    ajaxLoadingOutletCards = false;
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

    $(document).on('click', '.route_regis_00023_78', function() {

        $("#loader_httpFeed").show();
        let id = $(this).attr("id");

        let res = {
            id: id
        }

        $.ajax({
            type: "POST",
            url: "filesmanagers/sales_route_plan/salesservers.php",
            data: res,
            dataType: "json",
            success: function(xhr) {
                if (xhr.status === 200) {
                    $('.r_m_r_oute_mappers' + id).empty();
                    $('.r_m_r_oute_mappers' + id).append('');
                    dalert.alert('Successfully UnAssigned');
                    $("#loader_httpFeed").hide();
                } else {
                    $('.r_m_r_oute_mappers' + id).empty();
                    dalert.alert('Successfully UnAssigned');
                    $("#loader_httpFeed").hide();
                }
            },
            error: function(xhr) {
                if (xhr.status.trim() == 404) {
                    $("#loader_httpFeed").hide();
                    dalert.alert("internet connection working");
                } else {
                    $("#loader_httpFeed").hide();
                    dalert.alert("internet is down");
                }
            }

        });

    })



    $(document).on('click', '.btn_customers_cards_cust_op_tokens', function() {

        $("#loader_httpFeed").show();
        let id = $(this).attr("id");
        let username = $(this).attr("lang");

        if (!ajaxLoadingCustomersCards) {

            ajaxLoadingCustomersCards = true;

            let req = {
                id: id
            }

            $.ajax({
                type: "POST",
                url: "filesmanagers/tokenmanager/token_manager_light_box.php",
                data: req,
                cache: false,
                success: function(msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Token Manager-> ${username.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxLoadingCustomersCards = false;
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
    });

    $(document).on('click', '.btn_customers_cards_cust_op_integrity', function() {

        $("#loader_httpFeed").show();
        let id = $(this).attr("id");
        let username = $(this).attr("lang");

        if (!ajaxLoadingCustomersCards) {

            ajaxLoadingCustomersCards = true;

            let req = {
                id: id
            }

            $.ajax({
                type: "POST",
                url: "filesmanagers/integrity/integrity_manager_light_box.php",
                data: req,
                cache: false,
                success: function(msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Load Out VS Sales-> ${username.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxLoadingCustomersCards = false;
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
    });

    $(document).on('click', '.route_regis_00023_token_update', function() {

        $("#loader_httpFeed").show();
        let getOutletsId = $(this).attr("id");
        let getPhoneNo = $('.et_t_b_m_v_m' + getOutletsId).val();

        if (getPhoneNo.length !== 11) {
            $("#loader_httpFeed").hide();
            dalert.alert("Incorrect Phone Numebr");
        } else {

            let req = {
                urno: getOutletsId,
                phoneno: getPhoneNo
            }

            $.ajax({
                type: "POST",
                url: "filesmanagers/tokenmanager/update_token.php",
                data: req,
                cache: false,
                dataType: "json",
                success: function(xhr) {
                    if (xhr.status == 200) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("Successfully Update with " + getPhoneNo);
                    }
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

    $(document).on('click', '.route_regis_00023_send_token', function() {

        $("#loader_httpFeed").show();
        let getOutletsId = $(this).attr("id");

        let req = {
            urno: getOutletsId
        }

        $.ajax({
            type: "POST",
            url: "filesmanagers/tokenmanager/sendsms.php",
            data: req,
            cache: false,
            dataType: "json",
            success: function(xhr) {
                if (xhr.status == 200) {
                    $("#loader_httpFeed").hide();
                    dalert.alert("Token Successfully Send ");
                } else {
                    $("#loader_httpFeed").hide();
                    dalert.alert("Token not Successfully Send ");
                }
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
    });


    $(document).on('click', '.sys_edit_daily', function() {

        $("#loader_httpFeed").show();
        let username = $(this).attr("lang");
        let employeeid = $(this).attr("id");
        let getDays = $('.outletdays').val();

        if (!ajaxLoadingUsersEdit) {

            ajaxLoadingUsersEdit = true;

            let req = {
                employee_id: employeeid,
                myTodayOutlet: getDays
            };

            $.ajax({
                type: "POST",
                url: "filesmanagers/daily_outlet_manager/daily_outlets",
                data: req,
                cache: false,
                success: function(msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `${getDays},  Outlets -> ${username.toUpperCase()}`,
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


    $(document).on('click', '.customer_mobile_number_update_001', function() {

        $("#loader_httpFeed").show();
        let id = $(this).attr("id");

        let res = {
            id: id
        }

        $.ajax({
            type: "POST",
            url: "filesmanagers/mobile_number/salesservers.php",
            data: res,
            dataType: "json",
            success: function(xhr) {
                dalert.alert(xhr.status);
                $('.btn_manager_model_customers' + id).fadeOut("slow");
                $("#loader_httpFeed").hide();

            },
            error: function(xhr) {
                if (xhr.status.trim() == 404) {
                    $("#loader_httpFeed").hide();
                    dalert.alert("internet connection working");
                } else {
                    $("#loader_httpFeed").hide();
                    dalert.alert("internet is down");
                }
            }
        });
    })

    
    $(document).on('click', '.btn_tm_outlets_fetch_all', function() {
        $("#loader_httpFeed").show();
        let employeeid = $(this).attr("lang");

        if (!ajaxLoadingOutletCards) {
            ajaxLoadingOutletCards = true;
            let req = {
                employeeid: employeeid
            }

            $.ajax({
                type: "POST",
                url: "filesmanagers/tokenmanager/fetch.php",
                data: req,
                cache: false,
                success: function(msg) {
                    $("#fetch_here_token").html(msg)
                    $("#loader_httpFeed").hide();
                    ajaxLoadingOutletCards = false;
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