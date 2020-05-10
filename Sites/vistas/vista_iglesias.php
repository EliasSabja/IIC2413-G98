<?php include('../templates/header.html');   ?>

        <!-- Main -->
        <form id="consultar_iglesias" action ="../consultas/consulta_iglesias.php" method="post">
        <div class="wrapper style1">

            <div class="container">
                <article id="main" class="special">
                    <header>
                        <h4>Ingrese el nombre de la ciudad deseada</h4>
                        <input type="text" name="ciudad">
                        <h4>Ingrese la hora de apertura</h4>
                        <input type="text" name="hora_apertura">
                        <h4>Ingrese la hora de cierre</h4>
                        <input type="text" name="hora_cierre">
                        <h2><a onclick="document.getElementById('consultar_iglesias').submit()">Ver nombres de las iglesias abiertas en la ciudad indicada y en los horarios indicados</a></h2>
                    </header>
                </article>
                <hr />
            </div>
        </div>
        </form>

<?php include('../templates/footer.html'); ?>