<?php include('../templates/header.html');   ?>

        <!-- Main -->
        <form id="consultar_lugares" action ="../consultas/consulta_lugares.php" method="post">
        <div class="wrapper style1">

            <div class="container">
                <article id="main" class="special">
                    <header>
                        <h2><a onclick="document.getElementById('consultar_lugares').submit()">Ver nombre de cada lugar que tenga obras de todos los periodos de arte que existen en la base de datos</a></h2>
                    </header>
                </article>
                <hr />
            </div>
        </div>
        </form>
        
<?php include('../templates/footer.html'); ?>