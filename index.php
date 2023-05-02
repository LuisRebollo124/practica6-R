<?php
include_once "conexion.php";
if(isset($_GET["letra"])){
    $letra=$_GET["letra"];
}
else{
    $letra="A";
}
if(isset($_GET["orden"])){
    $orden=$_GET["orden"];
}
else{
    $orden = "l.nombre";
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>
    <style>
        nav{
            text-align: center;
        }
        h1{
            text-align: center;
        }
        table{
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <h1>Listado de localidades</h1>
    <nav>
        <p>Listar por letra:
            <a href="index.php?letra=A"> A <?php $letra="A"?></a>
            <a href="index.php?letra=B"> B <?php $letra="B"?></a>
            <a href="index.php?letra=C"> C <?php $letra="C"?></a>
            <a href="index.php?letra=D"> D <?php $letra="D"?></a>
            <a href="index.php?letra=E"> E <?php $letra="E"?></a>
            <a href="index.php?letra=F"> F <?php $letra="F"?></a>
            <a href="index.php?letra=G"> G <?php $letra="G"?></a>
            <a href="index.php?letra=H"> H <?php $letra="H"?></a>
            <a href="index.php?letra=I"> I <?php $letra="I"?></a>
            <a href="index.php?letra=J"> J <?php $letra="J"?></a>
            <a href="index.php?letra=K"> K <?php $letra="K"?></a>
            <a href="index.php?letra=L"> L <?php $letra="L"?></a>
            <a href="index.php?letra=M"> M <?php $letra="M"?></a>
            <a href="index.php?letra=N"> N <?php $letra="N"?></a>
            <a href="index.php?letra=O"> O <?php $letra="O"?></a>
            <a href="index.php?letra=P"> P <?php $letra="P"?></a>
            <a href="index.php?letra=Q"> Q <?php $letra="Q"?></a>
            <a href="index.php?letra=R"> R <?php $letra="R"?></a>
            <a href="index.php?letra=S"> S <?php $letra="S"?></a>
            <a href="index.php?letra=T"> T <?php $letra="T"?></a>
            <a href="index.php?letra=U"> U <?php $letra="U"?></a>
            <a href="index.php?letra=V"> V <?php $letra="V"?></a>
            <a href="index.php?letra=W"> W <?php $letra="W"?></a>
            <a href="index.php?letra=X"> X <?php $letra="X"?></a>
            <a href="index.php?letra=Y"> Y <?php $letra="Y"?></a>
            <a href="index.php?letra=Z"> Z <?php $letra="Z"?></a>
        </p>
    </nav>
    <main class="container">
        <div>
            <div>
                <?php
                try {
                    $con = getConexion();
                    $sql = "SELECT l.nombre ,p.nombre, l.poblacion From localidades l
                                    join provincias p on l.id_localidad = p.id_capital
                                    where INSTR(l.nombre,?)=1 order by $orden";
                    $st = $con->prepare($sql);
                    $st->bind_param("s", $letra);
                    $st->execute();
                    $st->bind_result($localidad,$provincia,$poblacion);
                    while ($st->fetch()){
                        echo "<table>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th><a href="."index.php?orden=l.nombre".">Localidad</a></th>";
                                    echo "<th><a href="."index.php?orden=p.nombre,l.nombre".">Provincia</a></th>";
                                    echo "<th><a href="."index.php?orden=poblacion||desc".">Población</a></th>" ;
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                                echo "<tr>";
                                    echo "<td>$localidad</td>";
                                    echo "<td>$provincia</td>";
                                    echo "<td>$poblacion</td>";
                                echo "</tr>";
                            echo "</tbody>";
                        echo "</table>";
                    }
                    $st->close();
                    $con->close();
                }
                catch (mysqli_sql_exception $e){

                }
                ?>

            </div>
        </div>
    </main>
</body>
</html>