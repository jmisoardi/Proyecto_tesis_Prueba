    </main>
        
        <footer>
            <!-- place footer here -->
        </footer>

        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
        
        <!--Script para data table (diseño)-->
        <script>
            $(document).ready( function(){
                $("#tabla_id").DataTable ({"pagelLength":10, lengthMenu:[[10,20,30,50],[10,20,30,50]], "language":{"url":"https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"}});  });
        </script>
        
        <!--Sweet alert -->
        <script>
            function borrar(id){
                Swal.fire({
                    title: "¿Desea borrar el registro?",
                    showCancelButton: true,
                    confirmButtonText: "Si",
                        }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location="index.php?txtID="+id;
                                    Swal.fire("Registro Borrado", "", "success");
                                } 
                            }
                        );
            }
        </script>
    </body>
</html>
