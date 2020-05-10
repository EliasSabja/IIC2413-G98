<?php include('../templates/header.html');   ?>

        <!-- Main -->
        <form id="consultar_museos_renac" action ="../consultas/consulta_museos_renac.php" method="post">
        <div class="wrapper style1">

            <div class="container">
                <article id="main" class="special">
                    <header>
                    <h4>Ingrese el nombre del país deseado</h4>
                    <input type="text" name="pais">
                        <h2><a onclick="document.getElementById('consultar_museos_renac').submit()">Ver museos que tengan obras del renacimiento en el país seleccionado</a></h2>
                    </header>
                </article>
                <hr />
            </div>
        </div>
        </form>

<?php include('../templates/footer.html'); ?>