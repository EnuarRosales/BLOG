@livewireScripts
        <script src="{{ asset('template/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('template/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('template/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('template/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
{{--
        <script>
            $(document).ready(function() {
                  Actualiza la tabla cada 5 segundos (5000 ms)
            });
        </script> --}}
        <script>
            $(document).ready(function() {
                App.init();

                /*function updateTable() {

                    console.log("Haciendo solicitud a la ruta: {{ route('admin.users.index') }}");
                    $.ajax({
                        url: "{{ route('admin.users.index') }}",
                        type: "GET",
                        dataType: "html",
                        success: function(data) {
                            $("#html5-extension tbody").html(data);
                            console.log("Tabla actualizada");
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        },
                    });
                }

                setInterval(updateTable, 5000);*/
            });
        </script>
        <script src="{{ asset('template/plugins/highlight/highlight.pack.js') }}"></script>
        <script src="{{ asset('template/assets/js/app.js') }}"></script>

        <script src="{{ asset('template/assets/js/custom.js') }}"></script>
        <script src="{{ asset('template/assets/js/elements/tooltip.js') }}"></script>
        <script src="{{ asset('template/plugins/sweetalerts/promise-polyfill.js') }}"></script>
        <script src="{{ asset('template/plugins/table/datatable/datatables.js') }}"></script>
        <script src="{{ asset('template/assets/js/scrollspyNav.js') }}"></script>
        <script src="{{ asset('template/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('template/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
        <script src="{{ asset('template/plugins/tagInput/tags-input.js') }}"></script>
        <!-- END GLOBAL MANDATORY SCRIPTS -->
