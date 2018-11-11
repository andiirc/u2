<template>
    <div>
        <div class="panel-body" v-if="profile">
            <div class="form-group col-lg-8">
            <div class="form-group col-lg-4">
                <label class="col-sm-12 control-label">Nombre</label>
                <div class="col-lg-12">
                    {{ profile.name }}
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label  class="col-sm-12 control-label">Nombre Usuario</label>
                <div class="col-lg-12">
                    {{ profile.username }}
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label class="col-sm-12 control-label">Email</label>
                <div class="col-lg-12">
                    {{ profile.email }}
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label class="col-sm-12 control-label">Ciudad</label>
                <div class="col-lg-12">
                    {{ profile.city }}
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label class="col-sm-12 control-label">Aministrador</label>
                <div class="col-lg-12">
                    {{ profile.admin == 1 ? 'Si': 'No' }}
                </div>
            </div>

            <div class="form-group col-lg-4">
                <label  class="col-sm-12 control-label">Creado</label>
                <div class="col-lg-12">
                    {{ profile.created_at }}
                </div>
            </div>
            </div>
            <div class="form-group col-lg-4">
                <div class="col-sm-8">
                    <input type="text" name="hobby" id="hobby" class="form-control col-lg-12"
                       placeholder="Agregar Pasatiempo" v-model="hobby">
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary" @click.prevent="create(profile, profile.id)">Agregar</button>
                </div>
                <label  class="col-sm-12 control-label">Pasatiempos</label>
                <div v-for="(ho, index) in profile.hobby" :key="index" class="tabs-position">
                    <el-tag type="success"> {{ho}} </el-tag>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

    export default {

        name: "profile-user",

        data(){
            return {
                hobby: '',
                profile: {
                    name: '',
                    username: '',
                    city:'',
                    admin: '',
                    hobby:[],
                    email:'',
                },
                errors: []
            }
        },

        mounted(){
            this.getProfile();
        },

        methods:{

            getProfile(){
                this.$http.get('/api/profile').then( res => {
                    this.$set(this.$data, 'profile', res.data)
                }).catch(err => {
                    if(err) this.$set(this.$data, 'errors', err.response.data.errors)
                })
            },

            create(profile, id){
                profile.hobby.push(this.hobby)
                this.$http.patch(`/api/profile/${id}`, profile).then(res => {
                    this.hobby = ''
                }).catch(err => {
                    if (err) console.log(err)
                })
            }

        }

    }
</script>

<style scoped>
    .el-tag--success {
        margin: 2px 2px 0px 0px;
    }
    .tabs-position{
        display: inline-block
    }
</style>