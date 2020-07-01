 <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; <a href="#">NBEAC</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ URL::asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ URL::asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
{{--<script>--}}
  {{--$.widget.bridge('uibutton', $.ui.button);--}}
{{--</script>--}}
<!-- Bootstrap 3.3.7 -->
<script src="{{ URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- daterangepicker -->
<script src="{{ URL::asset('bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{ URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ URL::asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{ URL::asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ URL::asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('dist/js/adminlte.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ URL::asset('dist/js/demo.js')}}"></script>

 <script>
   $(document).ready(function(){
       $('.select2-selection').css('height','33px');
       $('[data-toggle = "tooltip"]').tooltip();

     $('[data-toggle="popover"]').popover();
   });

   //// add, remove error class
   let addClass = (e) => {
       $('#'+e).parent().addClass('has-error');
   }
   let removeClass = (e) => {
       $('#'+e).parent().removeClass('has-error')
   }
 </script>
 </body>
</html>
