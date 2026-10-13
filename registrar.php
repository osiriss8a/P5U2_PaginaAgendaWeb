<?php
require_once "conexion.php";

/* =========================
   CARGAR CATEGORÍAS
   ========================= */
$resultado = $pdo->query(
    "SELECT id, nombre FROM categorias ORDER BY nombre"
);

$categorias = $resultado->fetchAll(PDO::FETCH_ASSOC);

$idsValidos = array_map(
    'intval',
    array_column($categorias, 'id')
);

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

/* =========================
   RECIBIR DATOS
   ========================= */
$titulo = trim($_POST["titulo"] ?? "");
$cliente = trim($_POST["cliente"] ?? "");
$fecha = $_POST["fecha"] ?? "";
$hora = $_POST["hora"] ?? "";
$categoriaId = (int) ($_POST["categoria_id"] ?? 0);
$ubicacion = trim($_POST["ubicacion"] ?? "");
$descripcion = trim($_POST["descripcion"] ?? "");

/* =========================
   VALIDACIONES
   ========================= */
if ($titulo === "") {
    die("El título es obligatorio.");
}

if ($cliente === "") {
    die("El nombre del cliente es obligatorio.");
}

if ($fecha === "") {
    die("La fecha es obligatoria.");
}

if ($hora === "") {
    die("La hora es obligatoria.");
}

/* =========================
   VALIDAR CATEGORÍA
   ========================= */
if (!in_array($categoriaId, $idsValidos, true)) {
    die("La categoría seleccionada no es válida.");
}

/* =========================
   INSERTAR EN MYSQL
   ========================= */
$sql = "INSERT INTO eventos
        (titulo, cliente, fecha, hora, categoria_id, ubicacion, descripcion)
        VALUES
        (:titulo, :cliente, :fecha, :hora, :categoria_id, :ubicacion, :descripcion)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":titulo" => $titulo,
    ":cliente" => $cliente,
    ":fecha" => $fecha,
    ":hora" => $hora,
    ":categoria_id" => $categoriaId,
    ":ubicacion" => $ubicacion,
    ":descripcion" => $descripcion
]);

/* =========================
   REGRESAR A MI AGENDA
   ========================= */
header("Location: agenda.php?guardado=1");
exit;
?>