//recibimos datos para enviar item
export const getData = id_user => {
	let data = localStorage.getItem(id_user)
	return JSON.parse(data)
}

//guardamos datos en cadena srting
export const saveData = (id_user, data) => {
	console.log(data)
	localStorage.setItem(id_user, JSON.stringify(data))
}
//eliminar data temporal del load en el local storage
export const deleteData = id_user => {
	localStorage.removeItem(id_user)
}
