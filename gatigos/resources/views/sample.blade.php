@extends('layouts.appCalendar')

@section('content')
    <div>
      @if (Session::has('error'))
        <div class="alert alert-danger align-items-center" role="alert">{{Session::get('error')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @if (Session::has('success'))
        <div class="alert alert-success" role="alert">{{Session::get('success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      <div id="calhead" style="padding-left:1px;padding-right:1px;">
            <div class="cHead"><div class="ftitle">{{ __('language.datesCalendar')}} </div>
            <div id="loadingpannel" class="ptogtitle loadicon" style="display: none;">{{ __('language.loadingData')}}</div>
             <div id="errorpannel" class="ptogtitle loaderror" style="display: none;">{{ __('language.sorryMessage')}}</div>
            </div>

            <div id="caltoolbar" class="ctoolbar">
              <div id="faddbtn" class="fbutton">
                <div><span title='Click to Create New Event' class="addcal">
                {{ __('language.newEvent')}}
                </span></div>
            </div>
            <div class="btnseparator"></div>
             <div id="showtodaybtn" class="fbutton">
                <div><span title='Click to back to today ' class="showtoday">
                {{ __('language.today')}}</span></div>
            </div>
              <div class="btnseparator"></div>

            <div id="showdaybtn" class="fbutton">
                <div><span title='Day' class="showdayview">{{ __('language.day')}}</span></div>
            </div>
              <div  id="showweekbtn" class="fbutton fcurrent">
                <div><span title='Week' class="showweekview">{{ __('language.week')}}</span></div>
            </div>
              <div  id="showmonthbtn" class="fbutton">
                <div><span title='Month' class="showmonthview">{{ __('language.month')}}</span></div>

            </div>
            <div class="btnseparator"></div>
              <div  id="showreflashbtn" class="fbutton">
                <div><span title='Refresh view' class="showdayflash">{{ __('language.refresh')}}</span></div>
                </div>

             <div class="btnseparator"></div>
            <div id="sfprevbtn" title="Prev"  class="fbutton">
              <span class="fprev"></span>

            </div>
            <div id="sfnextbtn" title="Next" class="fbutton">
                <span class="fnext"></span>
            </div>
            <div class="fshowdatep fbutton">
                    <div>
                        <input type="hidden" name="txtshow" id="hdtxtshow" />
                        <span id="txtdatetimeshow">{{ __('language.loading')}}</span>
                    </div>
            </div>
                        <div id="mailing"><form method="POST" action="mailingAlert">   {{ csrf_field() }}<button class="btn-primary" type="submit"><img src="https://img.icons8.com/office/20/000000/error.png"><img src="https://img.icons8.com/ios-glyphs/20/000000/email.png">{{__('language.alertMail')}}</button></form></div>
            <div class="clear"></div>
            </div>
      </div>
      <div style="padding:1px;">

        <div class="t1 chromeColor">
            &nbsp;</div>
        <div class="t2 chromeColor">
            &nbsp;</div>
        <div id="dvCalMain" class="calmain printborder">
            <div id="gridcontainer" style="overflow-y: visible;">
            </div>
        </div>
        <div class="t2 chromeColor">

            &nbsp;</div>
        <div class="t1 chromeColor">
            &nbsp;
        </div>
        </div>

  </div>
@endsection
