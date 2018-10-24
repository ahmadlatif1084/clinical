<!-- jQuery CDN -->
<script src="{{ asset('public/js/jquery-3.3.1.min.js') }}"></script>
<!-- Bootstrap Js CDN -->
<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/jquery.dataTables.min.js') }} "></script>
<script src="{{ asset('public/js/dataTables.rowReorder.min.js') }} "></script>
<script src="{{ asset('public/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/js/sweetalert.min.js') }} "></script>
<script src="{{ asset('public/js/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('public/js/chosen.jquery.min.js') }}"></script>
<script type="text/javascript">
    $('#datetimepicker,#datetimepicker2').datetimepicker();
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
        var table = $('#example').DataTable( {
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true
        } );
        $(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });

        $('#language').on('change', function () {
            var locale=$(this).val();
            // alert("language" + locale);

            console.log("locale=" + locale);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'language',
                // datatType : 'json',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "local": locale
                },
                success:function(response) {
                    console.log("success",response);
                     // window.location.reload();
                },
                error:function(response) {
                    // console.log("error");
                    // window.location.reload();
                },
                beforeSend:function() {
                    // console.log("beforeSend");
                    // window.location.reload();
                },
                complete:function(response) {
                    // console.log("complete");
                    // window.location.reload();
                }
            });
        });


    });
</script>
