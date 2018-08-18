        <!-- begin theme-panel -->
        
        <!-- end theme-panel -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	
	
    <!-- <script src="{{asset('public/backend/plugins/jquery-ui/ui/minified/jquery-ui.min_2.js')}}"></script> -->
    <script src="{{asset('public/backend/plugins/jquery/jquery-migrate-1.1.0.min_2.js')}}"></script>
	<script src="{{asset('public/backend/plugins/jquery-ui/ui/minified/jquery-ui.min_2.js')}}"></script>
    <script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>

    <script src="{{asset('public/backend/plugins/bootstrap/js/bootstrap.min_2.js')}}"></script>

	<script src="{{asset('public/js/jquery-tagsinput.js')}}"></script>

	<script src="{{asset('public/backend/plugins/slimscroll/jquery.slimscroll.min_2.js')}}"></script>
	<script src="{{asset('public/backend/plugins/jquery-cookie/jquery.cookie_2.js')}}"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{asset('public/backend/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.all.min_2.js')}}"></script>
    <script src="{{asset('public/backend/js/form-wysiwyg.demo.min_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/morris/raphael.min_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/morris/morris_2.js')}}"></script>

    
    <script src="{{asset('public/backend/plugins/jquery-jvectormap/jquery-jvectormap.min_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-jvectormap/jquery-jvectormap-world-merc-en_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/bootstrap-calendar/js/bootstrap_calendar.min_2.js')}}"></script>
	<script src="{{asset('public/backend/plugins/gritter/js/jquery.gritter_2.js')}}"></script>
	<script src="{{asset('public/backend/js/dashboard-v2.min_2.js')}}"></script>
	<script src="{{asset('public/backend/js/apps.min_2.js')}}"></script>
    <script src="{{asset('public/js/chosen.jquery.min.js')}}"></script>
    <script src="{{asset('public/js/chosen.proto.min.js')}}"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{asset('public/backend/plugins/switchery/switchery.min_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/powerange/powerange.min_2.js')}}"></script>
    <script src="{{asset('public/backend/js/form-slider-switcher.demo.min_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/DataTables/media/js/jquery.dataTables_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/DataTables/media/js/dataTables.bootstrap.min_2.js')}}"></script>
    <script src="{{asset('public/backend/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min_2.js')}}"></script>
    <script src="{{asset('public/backend/js/table-manage-responsive.demo.min_2.js')}}"></script>
    <!-- tag -->
    

    <!-- ================== END PAGE LEVEL JS ================== -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery(document).ready(function(){
            jQuery(".chosen").chosen();
        });
    </script>
	<script>
        $(document).ready(function() {
            //DashboardV2.init();
            App.init();
        });
        function confirmDelete(){
            return confirm("Do You Sure Want To Delete This Data ?");
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
        $(function () {
          $("#datepicker").datepicker({ 
                autoclose: true, 
                todayHighlight: true
          }).datepicker('update', new Date());
        });

    </script>

    <script type="text/javascript">
        $(function () {
          $("#datepicker1").datepicker({ 
                autoclose: true, 
                todayHighlight: true
          }).datepicker('update', new Date());
        });

    </script>

</body>
</html>
