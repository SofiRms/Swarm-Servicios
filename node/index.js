const express = require('express');
const mysql = require('mysql');

const app = express();
const port = 80;

// Configuración de la conexión a la base de datos
const db = mysql.createConnection({
  host: '172.17.0.5',
  user: 'root',
  password: 'root1',
  database: 'prueba',
});

// Conectar a la base de datos
db.connect((err) => {
  if (err) {
    console.error('Error de conexión a la base de datos:', err);
    return;
  }
  console.log('Conexión exitosa a la base de datos MySQL');
});

// Ruta para obtener la lista de alumnos
app.get('/alumnos', (req, res) => {
  // Consulta SQL
  const sql = 'SELECT id, apellidos, nombres, dni FROM alumnos';

  // Ejecutar la consulta
  db.query(sql, (err, result) => {
    if (err) {
      console.error('Error al ejecutar la consulta:', err);
      res.status(500).json({ mensaje: 'Error interno del servidor' });
      return;
    }

    if (result.length > 0) {
      // Devolver los datos en formato JSON
      res.json(result);
    } else {
      res.json({ mensaje: 'No se encontraron resultados' });
    }
  });
});

app.listen(port, () => {
  console.log(`Servidor Express corriendo en el puerto ${port}`);
});
