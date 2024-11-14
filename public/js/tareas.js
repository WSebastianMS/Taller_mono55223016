// Selección del modal para eliminar tareas
const modalTarea = document.getElementById("modalEliminarTarea");
const closeBtnModalTarea = modalTarea.querySelector(".closeBtn");
const notBtnModalTarea = modalTarea.querySelector(".notBtn");

// Formulario para eliminar tarea
const tareaForm = document.forms["tareaForm"];

// Abrir modal de confirmación para eliminar una tarea
const onDeleteTarea = (id) => {
  const codInput = tareaForm["cod"];
  codInput.value = id;
  modalTarea.classList.remove("ocultarModal");
};

// Cerrar el modal
const closeModalTarea = () => {
  modalTarea.classList.add("ocultarModal");
};

// Manejo de eventos para cerrar el modal
closeBtnModalTarea.addEventListener("click", closeModalTarea);
notBtnModalTarea.addEventListener("click", closeModalTarea);

// Función para cambiar el estado de una tarea
const onChangeEstado = (id, estadoActual) => {
  const nuevoEstado = prompt("Ingrese el nuevo estado (pendiente, en proceso, terminada, en impedimento):", estadoActual);
  if (nuevoEstado && nuevoEstado !== estadoActual) {
    window.location.href = `cambiarEstado.php?id=${id}&estado=${nuevoEstado}`;
  }
};

// Función para reasignar la tarea a otro responsable
const onReasignarTarea = (id) => {
  const nuevoResponsable = prompt("Ingrese el email del nuevo responsable:");
  if (nuevoResponsable) {
    window.location.href = `reasignarTarea.php?id=${id}&responsable=${nuevoResponsable}`;
  }
};
