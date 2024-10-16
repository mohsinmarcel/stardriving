<!-- bundle -->
<script src="{{asset('assets/js/vendor.min.js')}}"></script>
<script src="{{asset('assets/js/app.min.js')}}"></script>

<!-- third party js -->
<script src="{{asset('assets/js/vendor/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- third party js ends -->

<!-- demo app -->
{{-- <script src="{{asset('assets/js/pages/demo.dashboard.js')}}"></script> --}}
<!-- end demo js-->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click','#logout-btn',function(){
        document.querySelector('#logout-form').submit();
    })
    function printErrorMsg(msg,container) {
      $(container).html('<ul style="list-style:none" class="pl-0"></ul>');
      $(container).css('display','block');
      if(typeof msg === 'string' || msg instanceof String){
        $(container).find("ul").append('<li>'+msg+'</li>');
        return;
      }
      $.each( msg, function( key, value ) {
         $(container).find("ul").append('<li>'+value+'</li>');
      });
   }
</script>
@stack('scripts')