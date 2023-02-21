<template>
	<div
		class="modal fade"
		id="user_modal"
		tabindex="-1"
		role="dialog"
		aria-labelledby="exampleModalLabel"
		aria-hidden="true"
	>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						{{ `${is_create ? 'crear' : 'Actualizar'} usuario` }}
					</h5>

					<button
						type="button"
						class="btn-close"
						data-bs-dismiss="modal"
						aria-label="Close"
					></button>
				</div>

				<div class="modal-body">
					<label for="rol" class="form-label">Rol</label>

					<v-select
						:options="roles"
						v-model="user.role_id"
						:reduce="rol => rol.id"
						label="name"
                        >
						id="rol_id"
						class="modal-body mb-3"
					>
					</v-select>

					<form id="validacion"  novalidate="true"  method="post" @submit.prevent="storeUser">
                        <p v-if="errors.length">
                        <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
                        <ul>
                        <li ></li>
                        </ul>
                    </p>
						<div class="mb-3">
							<label for="name" class="form-label" required>number_id</label>
							<input
								type="number"
								class="form-control"
								id="number_id"
								v-model="user.number_id"
							/>
						</div>

						<div class="mb-3">
							<label for="name" class="form-label">name</label>
							<input type="text" class="form-control" id="name" v-model="user.name" />
						</div>
						<div class="mb-3">
							<label for="name" class="form-label">last_name</label>
							<input
								type="text"
								class="form-control"
								id="last_name"
								v-model="user.last_name"
							/>
						</div>

						<div class="mb-3">
							<label for="name" class="form-label">email</label>
							<input
								type="email"
								class="form-control"
								id="email"
								v-model="user.email"
							/>
						</div>

						<div class="mb-3">
							<label for="name" class="form-label">password</label>
							<input
								type="password"
								class="form-control"
								id="password"
								v-model="user.password"
							/>
						</div>
						<div class="mb-3">
							<label for="name" class="form-label">confirm_password</label>
							<input
								type="password"
								class="form-control"
								id=" confirm_password"
								v-model="user.confirm_password"
							/>
						</div>

						<hr />
						<section class="d-flex justify-content-end mt-3">
							<button
								type="button"
								class="btn btn-secondary me-2"
								data-dismiss="modal"
							>
								Cerrar
							</button>
							<button type="submit" class="btn btn-primary">

								{{ `${is_create ? 'crear' : 'Actualizar'}` }}
							</button>
						</section>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['user_data'],

		data() {
			return {
				is_create: true,
				user: {},
				roles: [],
                number_id:null,
                name:null,
                last_name:null,
                email:null,
                password:null,
                confirm_password:null,
                errors:[],


			}
		},
		created() {
			this.index()
		},
		methods: {
			index() {
                this.getRoles()
				this.setUser()
			},
			setUser() {
				if (!this.user_data) return
				this.user = { ...this.user_data }
				this.is_create = false
			},
			async storeUser() {
				try {



					if (this.is_create) {



						await axios.post('Users/SaveUser', this.user)
					} else {
                        // console.log(user);

						await axios.put(`Users/UpdateUser/${this.user.id}`, this.user)
					}
					swal.fire({
						icon: 'success',
						title: `Usuario ${this.is_create ? 'created' : 'updated'}`,
						text: 'Usuario registrado!'
					})

					// aca tenemos la funcion del modal padre

					this.$parent.closeModal()
				} catch (error) {
					console.error(error)
					swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Algo salio mal!'

					})
				}
			},
			async getRoles() {
				const { data } = await axios.get('Users/GetAllRoles')
				this.roles = data.roles
			},
		}
	}
</script>
