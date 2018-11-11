<template>
    <div>
        <div class="row">
            <div class="panel-body">
                <a href="/users" type="button" class="btn btn-info pull-left">Regresar</a>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Crear Usuarios</div>

            <div class="panel-body">
                <form >
                    <div class="form-group col-sm-6">
                        <label for="name">Nombres</label>
                        <input type="text" id="name" name="name" v-model="user.name" class="form-control" placeholder="Nombres">
                        <span v-if="errors.name" class="align-error alert-danger">
                            {{ errors.name[0] }}
                        </span>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="username">Nombre de usuario</label>
                        <input type="text"  id="username" name="username" v-model="user.username" class="form-control" placeholder="Nombre de usuario">
                        <span v-if="errors.username" class="align-error alert-danger">
                            {{ errors.username[0] }}
                        </span>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="city">Ciudad</label>
                        <input type="text"  id="city" name="city" v-model="user.city" class="form-control" placeholder="Ciudad">
                        <span v-if="errors.city" class="align-error alert-danger">
                            {{ errors.city[0] }}
                        </span>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="email">Email</label>
                        <input type="text"  id="email" name="email" v-model="user.email" class="form-control" placeholder="Email">
                        <span v-if="errors.email" class="align-error alert-danger">
                            {{ errors.email[0] }}
                        </span>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="admin" class="col-sm-12">Hobby</label>
                        <el-select id="admin" name="admin" v-model="user.hobby"  multiple filterable="" allow-create placeholder="Escribe tus hobbies" class="col-sm-12" >
                            <el-option  v-for="item in options"  :key="item.value"  :label="item.label" :value="item.value">
                            </el-option>
                        </el-select>
                        <span v-if="errors.hobby"  class="align-error alert-danger">
                            {{ errors.hobby[0] }}
                        </span>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="role" class="col-sm-12">Admin</label>
                        <el-select id="role" name="role" v-model="user.admin" filterable placeholder="Tipo de Usuario" class="col-sm-12">
                            <el-option  v-for="item in userType"  :key="item.value"  :label="item.label"  :value="item.value">
                            </el-option>
                        </el-select>
                        <span v-if="errors.admin" class="align-error alert-danger">
                            {{ errors.admin[0] }}
                        </span>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" v-model="user.password" class="form-control" placeholder="Contraseña">
                        <span v-if="errors.password" class="align-error alert-danger">
                            {{ errors.password[0] }}
                        </span>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="password_confirm">Confirmar contraseña</label>
                        <input type="password" id="password_confirm" name="password_confirm" v-model="user.password_confirm" class="form-control" placeholder="Confirmar Contraseña">
                        <span v-if="errors.password_confirm" class="align-error alert-danger">
                            {{ errors.password_confirm[0] }}
                        </span>
                    </div>

                </form>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary" @click.prevent="create">Guardar</button>
            </div>
        </div>

    </div>
</template>

<script>

    //import FormError from "../FormErrors.vue"

    export default {

        name: "users",
        components: {
            //'form-error': FormError,
        },

        data(){
            return {
                user: {
                    name: '',
                    username: '',
                    city:'',
                    admin: '',
                    hobby:[],
                    email:'',
                    password:'',
                    password_confirm:''

                },
                options:[{ value:'', label:''}],
                userType:[{ value:0, label:'No'},{ value:1, label:'Si'}],
                errors: []
            }
        },

        methods:{

            create(){
                this.$http.post( '/api/users', this.user ).then( res => {
                    this.$set(this.$data, 'errors', [])
                    this.clearInputs()
                    this.showNotify()
                    this.$emit('createProduct', true)
                }).catch(err => {
                    if(err) this.$set(this.$data, 'errors', err.response.data.errors)
                })
            },

            clearInputs(){
                this.user = {
                    name: '', username: '', city:'',  admin: '',
                    hobby:[],  email:'', password:'', password_confirm:''
                }
            },

            showNotify(){
                this.$notify({
                    message: 'usuario creado exitosamente',
                    type: 'success',
                    offset: 60
                })
            }
        }

    }
</script>

<style scoped>
</style>