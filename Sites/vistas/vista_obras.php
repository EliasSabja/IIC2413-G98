<?php include('../templates/header.html');   ?>

        <!-- Main -->
        <form id="consultar_obras" action="../consultas/consulta_obras.php" method="post"> 
        <div class="wrapper style1">

            <div class="container">
                <article id="main" class="special">
                    <header>
                        <h2><a onclick="document.getElementById('consultar_obras').submit()">Ver nombres de las obras de arte</a></h2>
                    </header>
                </article>
                <hr />
            </div>
        </div>
        </form>
        
<?php include('../templates/footer.html'); ?>