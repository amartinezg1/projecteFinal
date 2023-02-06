<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Gat i Gos ') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <title>	My Calendar </title>
    <link href="{{ asset('css/dailog.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/dp.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/alert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" />


    <!--  <script src="{{ asset('js/app.js') }}"></script> -->

    <script src="{{ asset('/src/jquery.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('src/Plugins/Common.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('src/Plugins/datepicker_lang_US.js') }}" type="text/javascript"></script>
    <script src="{{ asset('src/Plugins/jquery.datepicker.js') }}" type="text/javascript"></script>

    <script src="{{ asset('src/Plugins/jquery.alert.js') }}" type="text/javascript"></script>
    <script src="{{ asset('src/Plugins/jquery.ifrmdailog.js') }}" type="text/javascript"></script>
    <script src="{{ asset('src/Plugins/wdCalendar_lang_US.js') }}" type="text/javascript"></script>
    <script src="{{ asset('src/Plugins/jquery.calendar.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        $(document).ready(function() {
           var view="week";
            var DATA_FEED_URL = "php/datafeed.php";
            var op = {
                view: view,
                theme:3,
                showday: new Date(),
                EditCmdhandler:Edit,
                DeleteCmdhandler:Delete,
                ViewCmdhandler:View,
                onWeekOrMonthToDay:wtd,
                onBeforeRequestData: cal_beforerequest,
                onAfterRequestData: cal_afterrequest,
                onRequestDataError: cal_onerror,
                autoload:true,
                url: DATA_FEED_URL + "?method=list",
                quickAddUrl: DATA_FEED_URL + "?method=add",
                quickUpdateUrl: DATA_FEED_URL + "?method=update",
                quickDeleteUrl: DATA_FEED_URL + "?method=remove"
            };
            var $dv = $("#calhead");
            var _MH = document.documentElement.clientHeight;
            var dvH = $dv.height() + 2;
            op.height = _MH - dvH;
            op.eventItems =[];

            var p = $("#gridcontainer").bcalendar(op).BcalGetOp();
            if (p && p.datestrshow) {
                $("#txtdatetimeshow").text(p.datestrshow);
            }
            $("#caltoolbar").noSelect();

            $("#hdtxtshow").datepicker({ picker: "#txtdatetimeshow", showtarget: $("#txtdatetimeshow"),
            onReturn:function(r){
                            var p = $("#gridcontainer").gotoDate(r).BcalGetOp();
                            if (p && p.datestrshow) {
                                $("#txtdatetimeshow").text(p.datestrshow);
                            }
                     }
            });
            function cal_beforerequest(type)
            {
                var t="Loading data...";
                switch(type)
                {
                    case 1:
                        t="Loading data...";
                        break;
                    case 2:
                    case 3:
                    case 4:
                        t="The request is being processed ...";
                        break;
                }
                $("#errorpannel").hide();
                $("#loadingpannel").html(t).show();
            }
            function cal_afterrequest(type)
            {
                switch(type)
                {
                    case 1:
                        $("#loadingpannel").hide();
                        break;
                    case 2:
                    case 3:
                    case 4:
                        $("#loadingpannel").html("Success!");
                        window.setTimeout(function(){ $("#loadingpannel").hide();},2000);
                    break;
                }

            }
            function cal_onerror(type,data)
            {
                $("#errorpannel").show();
            }
            function Edit(data)
            {
               var eurl="edit.php?id={0}&start={2}&end={3}&isallday={4}&title={1}";
                if(data)
                {
                    var url = StrFormat(eurl,data);
                    OpenModelWindow(url,{ width: 600, height: 400, caption:"Manage  The Calendar",onclose:function(){
                       $("#gridcontainer").reload();
                    }});
                }
            }
            function View(data)
            {
                var str = "";
                $.each(data, function(i, item){
                    str += "[" + i + "]: " + item + "\n";
                });
                alert(str);
            }
            function Delete(data,callback)
            {

                $.alerts.okButton="Ok";
                $.alerts.cancelButton="Cancel";
                hiConfirm("Are You Sure to Delete this Event", 'Confirm',function(r){ r && callback(0);});
            }
            function wtd(p)
            {
               if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $("#showdaybtn").addClass("fcurrent");
            }
            //to show day view
            $("#showdaybtn").click(function(e) {
                //document.location.href="#day";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("day").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            //to show week view
            $("#showweekbtn").click(function(e) {
                //document.location.href="#week";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("week").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }

            });
            //to show month view
            $("#showmonthbtn").click(function(e) {
                //document.location.href="#month";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("month").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });

            $("#showreflashbtn").click(function(e){
                $("#gridcontainer").reload();
            });

            //Add a new event
            $("#faddbtn").click(function(e) {
                var url ="edit.php";
                OpenModelWindow(url,{ width: 500, height: 400, caption: "Create New Calendar"});
            });
            //go to today
            $("#showtodaybtn").click(function(e) {
                var p = $("#gridcontainer").gotoDate().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }


            });
            //previous date range
            $("#sfprevbtn").click(function(e) {
                var p = $("#gridcontainer").previousRange().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }

            });
            //next date range
            $("#sfnextbtn").click(function(e) {
                var p = $("#gridcontainer").nextRange().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });

        });
    </script>
</head>
<body>
    <div id="app">
                <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <!--<div class="container ml-1">-->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h2>{{ __('Gat i Gos') }}</h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                      @auth
                         <li class="nav-item">
                            <h5><a class="nav-link" href="/">{{ __('language.calendar') }}</a></h5>
                        </li>
                       <li class="nav-item">
                            <h5><a class="nav-link" href="/altas">{{ __('language.signUp') }}</a></h5>
                        </li>

                        <li class="nav-item">
                            <h5><a class="nav-link" href="/buscadorClientes">{{ __('language.searchEngine') }}</a></h5>
                        </li>
                        @if (Auth::user()->user_role=="vet")
                         <li class="nav-item">
                            <h5><a class="nav-link" href="/misCitas">{{ __('language.nextInquiry') }}</a></h5>
                        </li>
                        @endif
                        @if (Auth::user()->user_role=="admin")
                         <li class="nav-item">
                            <h5><a class="nav-link" href="/usuarios">{{ __('language.usersRole') }}</a></h5>
                        </li>
                        @endif
                      @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <h5><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></h5>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <h5><a class="nav-link" href="{{ route('register') }}">{{ __('language.register') }}</a></h5>
                                </li>
                            @endif
                        @else
                            <h5><li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  <h5><a class="dropdown-item" href="/perfil">
                                      {{ __('Perfil') }}
                                  </a></h5>
                                    <h5><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a></h5>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                </div>
                            </li></h5>
                        @endguest
                        <li><a href="{{ url('lang', ['en'])}}" class="p-2">English</a></li>
                        <li><a href="{{ url('lang', ['es'])}}" class="p-2">Español</a></li>
                        <li><a href="{{ url('lang', ['cat'])}}" class="p-2">Català</a></li>
                    </ul>
                </div>
            <!--</div>-->
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
