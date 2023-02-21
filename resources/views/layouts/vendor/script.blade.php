   <!-- jquery cdn -->
   <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
       crossorigin="anonymous"></script>
   <!-- bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
       integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
   </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
       integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
   </script>
   <!-- scripts -->
   <script src="{{ asset('frontendfiles/assets/js/script.js') }} "></script>

   <script src="{{ asset('frontendfiles/assets/plugins/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js') }}">
   </script>

   <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>

   <script type="text/javascript">
       var url = "{{ route('changeLang') }}";

       $(".changeLang").change(function() {
           alert("fdhskjfsd");
           window.location.href = url + "?lang=" + $(this).val();
       });
   </script>

   {!! Toastr::message() !!}
   <script>
       function loader() {
           $.blockUI({
               message: '<div class="spinner-border"><span class="sr-only">Loading...</span> </div>',
               fadeIn: 100,

               overlayCSS: {
                   backgroundColor: '#1b2024',
                   opacity: 0.8,
                   zIndex: 1200,
                   cursor: 'wait'
               },
               css: {
                   border: 0,
                   color: '#fff',
                   zIndex: 1201,
                   padding: 0,
                   backgroundColor: 'transparent'
               }
           });
       }
   </script>

   <script>
       $(document).on('click', '#MarkRead', function(e) {
           e.preventDefault();
           alert("fdkasjfdljsal");
           var url = $(this).attr('data-url');

           $.ajax({
               type: 'GET',
               url: url,
               success: function(data) {

               },
           });
       });
   </script>

   <script>
       $(document).on('submit', '#submit-form', function(e) {

           e.preventDefault();
           var currentevent = $(this);
           currentevent.attr('disabled');
           var form = new FormData($('#submit-form')[0]);
           var params = $('#submit-form').serializeArray();
           var route = $(this).attr('action');
           console.log(route);
           $.each(params, function(i, val) {
               form.append(val.name, val.value)
           });
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           $.ajax({
               type: "POST",
               url: route,
               contentType: false,
               processData: false,
               data: form,
               beforeSend: function(data) {
                   loader();
               },
               success: function(data) {

                   toastr.success(data.message);
                   $('#global-table').DataTable().ajax.reload();
                   $('#summernote-editor').summernote('code', '');
                   $('#submit-form').trigger("reset");
                   $('#globalModal').modal('hide');

                   currentevent.attr('disabled', false);

               },
               error: function(err) {
                   if (err.status == 422) {
                       $.each(err.responseJSON.errors, function(i, error) {
                           var el = $(document).find('[name="' + i + '"]');
                           el.after($('<span style="color: red;">' + error[0] + '</span>')
                               .fadeOut(4000));
                       });
                   }

                   currentevent.attr('disabled', false);
               },
               complete: function() {
                   $.unblockUI();
               }
           });

       });
   </script>

   @stack('scripts')
