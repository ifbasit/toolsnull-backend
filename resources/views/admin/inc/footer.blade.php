            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; {{ config('app.name') }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <script src="{{asset('admin-assets/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('admin-assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('admin-assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
	<script src="{{asset('admin-assets/js/sb-admin-2.min.js')}}"></script>
	<script src="{{asset('admin-assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('admin-assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('admin-assets/js/demo/datatables-demo.js')}}"></script>
    


    <!-- TINY MCE -->
     <script>
        tinymce.init({
          selector: '.TinyMCE',
          plugins: '  autolink lists  media    table  ',
          toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
          toolbar_mode: 'floating',
          tinycomments_mode: 'embedded',
          tinycomments_author: 'Author name',
       });
      </script>