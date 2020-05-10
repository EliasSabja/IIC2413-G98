<?php include('../templates/header.html');   ?>

        <!-- Main -->
        <form id="consultar_obras_artista" action ="../consultas/consulta_obras_artista.php" method="post">
        <div class="wrapper style1">

            <div class="container">
                <article id="main" class="special">
                    <header>
                        <h2><a onclick="document.getElementById('consultar_obras_artista').submit()">Ver número de obras de cada artista</a></h2>
                    </header>
                </article>
                <hr />
            </div>
        </div>
        </form>

<?php include('../templates/footer.html'); ?>