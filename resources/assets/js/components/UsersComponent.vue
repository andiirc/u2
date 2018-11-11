<template>
    <div>

        <div v-if="isEmpty">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Actualizar Usuario

                    <button type="button" class="close" aria-label="Close" @click.prevent="close()">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <div class="panel-body">
                    <form >
                        <div class="form-group col-sm-6">
                            <label for="name">Nombres</label>
                            <input type="text" id="name" name="name" v-model="user.name" class="form-control" placeholder="Nombres">
                            <span v-if="errors.name" class="help-block align-error">
                            {{ errors.name[0] }}
                        </span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="username">Nombre de usuario</label>
                            <input type="text"  id="username" name="username" v-model="user.username" class="form-control" placeholder="Nombre de usuario">
                            <span v-if="errors.username" class="help-block align-error">
                            {{ errors.username[0] }}
                        </span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="city">Ciudad</label>
                            <input type="text"  id="city" name="city" v-model="user.city" class="form-control" placeholder="Ciudad">
                            <span v-if="errors.city" class="help-block align-error">
                            {{ errors.city[0] }}
                        </span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="email">Email</label>
                            <input type="text"  id="email" name="email" v-model="user.email" class="form-control" placeholder="Email">
                            <span v-if="errors.email" class="help-block align-error">
                            {{ errors.email[0] }}
                        </span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="admin" class="col-sm-12">Hobby</label>
                            <el-select id="admin" name="admin" v-model="user.hobby"  multiple filterable="" allow-create placeholder="Escribe tus hobbies" class="col-sm-12" >
                                <el-option  v-for="item in options"  :key="item.value"  :label="item.label" :value="item.value">
                                </el-option>
                            </el-select>
                            <span v-if="errors.hobby"  class="help-block align-error">
                            {{ errors.hobby[0] }}
                        </span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="role" class="col-sm-12">Admin</label>
                            <el-select id="role" name="role" v-model="user.admin" filterable placeholder="Tipo de Usuario" class="col-sm-12">
                                <el-option  v-for="item in userType"  :key="item.value"  :label="item.label"  :value="item.value">
                                </el-option>
                            </el-select>
                            <span v-if="errors.admin" class="help-block align-error">
                            {{ errors.admin[0] }}
                        </span>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary" @click.prevent="update(user, user.id)">Actualizar</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

        <div class="panel-heading clearfix">
            <h4 class="col-lg-6">Usuarios</h4>
            <a href="/users/create" class="btn btn-primary pull-right" type="button">Crear Usuario</a>
        </div>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Nombre de Usuario</th>
                <th scope="col">Correo</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Perfil</th>
                <th scope="col">Pasatiempos</th>
                <th scope="col">Registrado</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users" :key="index">
                    <th scope="row">{{ user.id  }}</th>
                    <td>{{ user.name }}</td>
                    <td>{{ user.username }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.city }}</td>
                    <td>{{ user.admin == 1 ? 'Administrador': 'usuario' }}</td>
                    <td>{{ user.hobby }}</td>
                    <td>{{ user.created_at }}</td>
                    <td>
                        <button type="submit" class="btn btn-sm btn-danger" @click.prevent="remove(user.id, index)">Eliminar</button>
                        <button type="submit" class="btn btn-sm btn-info" @click.prevent="show(user.id, index)">Editar</button>
                    </td>
                </tr>
            </tbody>
         </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        name: "list-user",

        data(){
            return {
                indexUser: '',
                users: [],
                user: {},
                options:[{ value:'', label:''}],
                userType:[{ value:false, label:'No'},{ value:true, label:'Si'}],
                errors: []
            }
        },

        mounted(){
            this.getUsers();
        },

        methods:{

            getUsers(){
                this.$http.get('/api/users').then( res => {
                    this.$set(this.$data, 'users', res.data)
                }).catch(err => {
                    if(err) this.$set(this.$data, 'errors', err.response.data.errors)
                })
            },

            remove(id, index){
                this.$confirm('Deseas eliminar el usuario?', 'Advertencia', {
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    type: 'warning'
                }).then(() => {
                    this.deleteUser(id, index)
                    this.$message({
                        type: 'success',
                        message: 'Usuario eliminado exitosamente'
                    });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: 'Eliminacion cancelada'
                    });
                });
            },

            show(id, index){
                this.indexUser = index
                this.$http.get(`/api/users/${id}`).then(res => {
                    this.user = res.data;
                }).catch(err => {
                    if (err) console.log(err)
                })
            },

            update(user, id){
                this.$http.patch(`/api/users/${id}`, user).then(res => {
                    this.$set(this.users, this.indexUser, res.data)
                    this.indexUser = ''
                    this.showNotify()
                }).catch(err => {
                    if (err) console.log(err)
                })
            },

            deleteUser(id, index) {
                this.$http.delete(`/api/users/${id}`).then(res => {
                    this.$delete(this.users, index)
                }).catch(err => {
                    if (err) console.log(err)
                })
            },

            showNotify(){
                this.$notify({
                    message: 'usuario actualizado exitosamente',
                    type: 'success',
                    offset: 60
                })
            },

            close(){
                this.user = {}
            }
        },

        computed: {

            isEmpty(){
                return Object.keys(this.user).length !== 0
            }
        }

    }
</script>

<style scoped>
</style>