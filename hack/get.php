<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="response">Test</div>
        <a href="http://127.0.0.1:8090/Main/debit/xxx">Débiter</a>
        <img src="http://normal.local/csrf/get.php?id=zzzz" crossorigin="anonymous">

        <form method="post" action="http://normal.local/csrf/get.php">
            <h1>Vers PHP</h1>
            <input type="text" name="id" placeholder="Numéro de compte">
            <button>Valider</button>
        </form>

        <form method="post" action="http://127.0.0.1:8090/Main/debit/">
            <h1>Vers projet Ubiquity</h1>
            <input type="text" name="id" placeholder="Numéro de compte">
            <button>Valider</button>
        </form>

        <script>
            $.ajax({

                url: "http://normal.local/csrf/get.php?id=zzzz",
                context: document.body

            }).done(function (resp) {

                $( "#response" ).html( resp.data );

            });
        </script>
    </body>
</html>