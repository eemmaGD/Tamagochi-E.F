<?php
session_start();

/* ===== INICIALIZAR STATS ===== */
if (!isset($_SESSION["hambre"])) {
    $_SESSION["hambre"] = 5;
    $_SESSION["energia"] = 5;
    $_SESSION["felicidad"] = 5;
    $_SESSION["salud"] = 5;
    $_SESSION["higiene"] = 5;
}

/* ===== PROCESAR ACCIONES ===== */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    switch ($_POST["accion"]) {

        case "comer":
            $_SESSION["hambre"] += 3;
            $_SESSION["felicidad"] += 1;
            $_SESSION["higiene"] -= 2;
            $_SESSION["salud"] -= 0.5;
            break;

        case "energia":
            $_SESSION["energia"] += 4;
            $_SESSION["hambre"] -= 2;
            $_SESSION["higiene"] -= 1;
            break;

        case "feliz":
            $_SESSION["felicidad"] += 3;
            $_SESSION["energia"] -= 1;
            $_SESSION["hambre"] -= 1;
            break;

        case "curar":
            $_SESSION["salud"] += 4;
            $_SESSION["felicidad"] -= 1;
            break;

        case "limpiar":
            $_SESSION["higiene"] += 4;
            $_SESSION["felicidad"] += 1;
            break;

        case "reiniciar":
            $_SESSION["hambre"] = 5;
            $_SESSION["energia"] = 5;
            $_SESSION["felicidad"] = 5;
            $_SESSION["salud"] = 5;
            $_SESSION["higiene"] = 5;
            break;
    }

    /* ===== LIMITAR ENTRE 0 Y 10 ===== */
    $stats = ["hambre", "energia", "felicidad", "salud", "higiene"];

    foreach ($stats as $stat) {

        if ($_SESSION[$stat] > 10) {
            $_SESSION[$stat] = 10;
        }

        if ($_SESSION[$stat] < 0) {
            $_SESSION[$stat] = 0;
        }
    }
}

/* ===== VARIABLES ===== */
$hambre = $_SESSION["hambre"];
$energia = $_SESSION["energia"];
$felicidad = $_SESSION["felicidad"];
$salud = $_SESSION["salud"];
$higiene = $_SESSION["higiene"];
$img = "img/pocho def.png";

if ($salud<3){
    $img = "img/pocho sick.png";
}
elseif ($higiene<3){
    $img = "img/pocho sucio.png";
}
elseif ($felicidad<3 && $salud>=3){
    $img = "img/pocho sad.png";
}
elseif ($energia<3){
    $img = "img/pocho cansado.png";
}
elseif ($hambre<3){
    $img = "img/pocho angry.png";
}
elseif ($hambre>6 && $energia>6 && $felicidad>6 && $salud>6 && $higiene>6 && $hambre<9 && $energia<9 && $felicidad<9 && $salud<9 && $higiene<9){
    $img = "img/pocho def.png";
}
elseif ($hambre>=9 && $energia>=9 && $felicidad>=9 && $salud>=9 && $higiene>=9){
    $img = "img/pocho feliz.png";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pucho</title>
    <link rel="stylesheet" href="css/pucho.css">
</head>
<body>

<div class="titulo">
    <h1>PUCHO</h1>
</div>

<div class="container">

<div class="img personaje">

    <img src="<?php echo $img; ?>" alt="">

    <form method="POST" class="reiniciar-form">
        <button type="submit" name="accion" value="reiniciar" class="btn-img">
            <img src="img/reiniciar.webp" alt="Reiniciar">
        </button>
    </form>

</div>


    <div class="img">
        <div class="textazouwu">

            <p>Hola soy pucho, ahora tengo:</p>

            <!-- HAMBRE -->
            <form method="POST" class="fila">
                <div style="width: 100%;">
                    <span>hambre: <?php echo $hambre; ?></span>
                    <div class="barra">
                        <div class="progreso" style="width: <?php echo $hambre * 10; ?>%"></div>
                    </div>
                </div>

            </form>

            <!-- ENERGIA -->
            <form method="POST" class="fila">
                <div style="width:100%;">
                    <span>energia: <?php echo $energia; ?></span>
                    <div class="barra">
                        <div class="progreso" style="width: <?php echo $energia * 10; ?>%"></div>
                    </div>
                </div>
            </form>

            <!-- FELICIDAD -->
            <form method="POST" class="fila">
                <div style="width:100%;">
                    <span>felicidad: <?php echo $felicidad; ?></span>
                    <div class="barra">
                        <div class="progreso" style="width: <?php echo $felicidad * 10; ?>%"></div>
                    </div>
                </div>
            </form>

            <!-- SALUD -->
            <form method="POST" class="fila">
                <div style="width:100%;">
                    <span>salud: <?php echo $salud; ?></span>
                    <div class="barra">
                        <div class="progreso" style="width: <?php echo $salud * 10; ?>%"></div>
                    </div>
                </div>
            </form>

            <!-- HIGIENE -->
            <form method="POST" class="fila">
                <div style="width:100%;">
                    <span>higiene: <?php echo $higiene; ?></span>
                    <div class="barra">
                        <div class="progreso" style="width: <?php echo $higiene * 10; ?>%"></div>
                    </div>
                </div>
            </form>
<div class="minicontenedor">

<form method="POST">

    <button type="submit" name="accion" value="comer" class="btn-img">
        <img src="img/comer.png" alt="Comer">
    </button>

    <button type="submit" name="accion" value="energia" class="btn-img">
        <img src="img/ENERGIA.webp" alt="Dormir">
    </button>

    <button type="submit" name="accion" value="feliz" class="btn-img">
        <img src="img/felicidad.webp" alt="Jugar">
    </button>

    <div class="espacio"></div>

    <button type="submit" name="accion" value="curar" class="btn-img">
        <img src="img/salud.gif" alt="Curar">
    </button>

    <button type="submit" name="accion" value="limpiar" class="btn-img">
        <img src="img/higiene.webp" alt="Limpiar">
    </button>

</form>

</div>
            </div>
        </div>
    </div>

</div>

<div class="textazo">
    <p>cuidame para que no me muera porfis</p>
    
</div>

</body>
</html>