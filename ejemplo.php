<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="assets/css/mi.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <title>Análisis de Colores de Imagen</title>
</head>

<body>
    <input type="file" id="fileInput" accept="image/*">
    <img id="uploadedImage" style="max-width: 300px;">
    <p>PALETA DE COLORES</p>
    <div id="colorPalette"></div>

    <script src="dist/color-thief.umd.js"></script>
</body>
<script type="text/javascript">
    // Carga la imagen seleccionada por el usuario
    document.getElementById('fileInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            var image = new Image();
            image.src = e.target.result;

            image.onload = function() {
                var colorThief = new ColorThief();
                var palette = colorThief.getPalette(image, 8); // Puedes ajustar el número de colores en la paleta

                // Muestra la paleta de colores en la página
                const colorPalette = document.getElementById('colorPalette');
                colorPalette.innerHTML = '';
                // Recorre la paleta de colores y crea elementos para cada uno
                palette.forEach(function(color, index) {
                    // Crea un nuevo elemento div
                    const colorDiv = document.createElement('div');
                    colorDiv.className = `colores col-lg-color col-md-4 col-sm-6`;

                    // Crea un elemento label
                    const label = document.createElement('label');
                    label.className = 'cuadrado';
                    label.setAttribute('data-title', '');

                    // Crea un elemento input (checkbox)
                    const checkbox = document.createElement('input');
                    checkbox.name = 'colores';
                    checkbox.id = '';
                    checkbox.value = '';
                    checkbox.type = 'checkbox';

                    // Crea un elemento span para el checkmark
                    const checkmark = document.createElement('span');
                    checkmark.className = 'checkmark';
                    checkmark.style.backgroundColor = `rgb(${color[0]}, ${color[1]}, ${color[2]})`;

                    // Agrega el checkbox y el checkmark al label
                    label.appendChild(checkbox);
                    label.appendChild(checkmark);

                    // Agrega el label al div de color
                    colorDiv.appendChild(label);

                    // Agrega el div de color al contenedor de colores
                    colorPalette.appendChild(colorDiv);
                });
            };
        };

        reader.readAsDataURL(file);
    });
</script>

</html>