const botonesCarrito = document.querySelectorAll('.carrito-btn');
const listaCarrito = document.querySelector('.lista-carrito');
const totalSpan = document.getElementById('total');
const carrito = document.querySelector('.carrito');
let total = 0;

// Crear botón para alternar el estado del carrito
const toggleCarritoBtn = document.createElement('button');
toggleCarritoBtn.textContent = '⮞';
toggleCarritoBtn.className = 'toggle-btn';
carrito.appendChild(toggleCarritoBtn);

// Función para actualizar el total en la interfaz
const actualizarTotal = () => {
    totalSpan.textContent = total.toFixed(2);
};

// Función para añadir un producto al carrito
const agregarProductoAlCarrito = (nombreProducto, precioProducto) => {
    const li = document.createElement('li');
    li.textContent = `${nombreProducto} - $${precioProducto.toFixed(2)}`;

    const btnEliminar = document.createElement('button');
    btnEliminar.textContent = 'Eliminar';
    btnEliminar.className = 'btn-eliminar';

    // Añadir evento para eliminar el producto
    btnEliminar.addEventListener('click', () => {
        listaCarrito.removeChild(li);
        total -= precioProducto; // Restar el precio del total
        actualizarTotal(); // Actualizar el total
        guardarCarrito(); // Guardar el carrito actualizado en localStorage
    });

    li.appendChild(btnEliminar);
    listaCarrito.appendChild(li);

    total += precioProducto; // Actualizar el total
    actualizarTotal(); // Actualizar el total en la interfaz
    guardarCarrito(); // Guardar el carrito actualizado en localStorage
};

// Añadir productos al carrito al hacer clic
botonesCarrito.forEach(boton => {
    boton.addEventListener('click', () => {
        const producto = boton.parentElement;
        const nombreProducto = producto.querySelector('p').textContent;
        const precioProducto = parseFloat(producto.querySelector('.precio').textContent.replace('$', ''));

        agregarProductoAlCarrito(nombreProducto, precioProducto);
    });
});

// Alternar el estado del carrito (expandir/minimizar)
toggleCarritoBtn.addEventListener('click', () => {
    carrito.classList.toggle('minimizado');
    toggleCarritoBtn.textContent = carrito.classList.contains('minimizado') ? '⮜' : '⮞';
});

// Guardar el carrito en localStorage
const guardarCarrito = () => {
    const productosCarrito = [];
    listaCarrito.querySelectorAll('li').forEach(li => {
        const [nombre, precioTexto] = li.textContent.split(' - ');
        const precio = parseFloat(precioTexto.replace('$', ''));
        productosCarrito.push({ nombre, precio });
    });
    localStorage.setItem('carrito', JSON.stringify(productosCarrito));
};

// Cargar el carrito desde localStorage
const cargarCarrito = () => {
    const productosCarrito = JSON.parse(localStorage.getItem('carrito')) || [];
    productosCarrito.forEach(producto => {
        agregarProductoAlCarrito(producto.nombre, producto.precio);
    });
};

// Llama a cargarCarrito cuando se carga la página
document.addEventListener('DOMContentLoaded', cargarCarrito);
