USE agenda;

-- 1. Crear un respaldo de los eventos originales.
-- Ejecutar este paso solo si eventos_respaldo todavía no existe.
CREATE TABLE eventos_respaldo AS
SELECT * FROM eventos;

-- 2. Crear la tabla de categorías si todavía no existe.
CREATE TABLE IF NOT EXISTS categorias (
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50),
    PRIMARY KEY (id)
);

-- 3. Consultar las categorías registradas.
SELECT * FROM categorias;

-- 4. Verificar que eventos utilice categoria_id.
DESCRIBE eventos;

-- 5. Verificar la relación entre eventos y categorias.
SHOW CREATE TABLE eventos;

-- 6. Comprobar los eventos con el nombre de su categoría.
SELECT
    eventos.titulo,
    categorias.nombre AS categoria
FROM eventos
INNER JOIN categorias
    ON eventos.categoria_id = categorias.id;

-- 7. Contar los eventos de cada categoría.
SELECT
    categorias.nombre AS categoria,
    COUNT(eventos.id) AS total
FROM categorias
LEFT JOIN eventos
    ON categorias.id = eventos.categoria_id
GROUP BY categorias.id, categorias.nombre;